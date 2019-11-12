<?php
declare(strict_types=1);

namespace App\Model\InviaResortDataExtractor;

use App\Assembler\Resort\ResortAssembler;
use App\Dto\Resort\ResortCreateDto;
use App\Exception\ParsingException\InviaParsingException;
use DOMElement;
use DOMNode;
use Symfony\Component\DomCrawler\Crawler;

class InviaResortDataExtractor
{
    /** @var Crawler */
    private $crawler;

    /**
     * InviaResortDataExtractor constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->crawler = new Crawler($content);
    }

    /**
     * @return ResortCreateDto
     */
    public function parseForResortData(): ResortCreateDto
    {
        $data = $this->getBasicData();
        $data = $this->getLocation($data);
        $data = $this->getRating($data);

        return (new ResortAssembler())->toCreateDto($data);
    }

    /**
     * @return array
     */
    public function parseForPictures(): array
    {
        $data = $this->getPictures();
        return $data;
    }

    /**
     * @return array
     */
    private function getBasicData(): array
    {
        $jsonData = html_entity_decode($this->crawler->filter('script[type="application/ld+json"]')->html());
        $jsonData = json_decode($jsonData, true);

        if ($jsonData == null || count($jsonData) == 0) {
            throw new InviaParsingException('JSON with base information not found.');
        }

        $data = [];

        $data['name'] = $jsonData['name'];
        $data['description'] = $jsonData['description'];
        $data['source'] = $jsonData['url'];

        $data['latitude'] = null;
        $data['longitude'] = null;

        if (isset($jsonData['geo'])) {
            $data['latitude'] = $jsonData['geo']['latitude'];
            $data['longitude'] = $jsonData['geo']['longitude'];
        }

        $data['bestRating'] = $jsonData['aggregateRating']['bestRating'];
        $data['ratingValue'] = $jsonData['aggregateRating']['ratingValue'];
        $data['ratingCount'] = $jsonData['aggregateRating']['ratingCount'];

        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    private function getLocation(array $data): array
    {
        $location = $this->crawler->filter('.box-product-detail > .annot')->text();

        if ($location == "") {
            throw new InviaParsingException("Location parsing exception");
        }

        $location = str_replace(["\n", "\t", 'Zobrazit na mapě', '(', ')'], '', $location);
        $locations = explode(",", $location);
        $locationCount = count($locations);

        if ($locationCount != 0) {
            $data['country'] = $locations[0];
            $data['area'] = null;
            $data['city'] = null;
            if ($locationCount == 3) {
                $data['area'] = trim($locations[1]);
                $data['city'] = trim($locations[2]);
            } elseif ($locationCount == 2) {
                $data['area'] = null;
                $data['city'] = trim($locations[1]);
            }
        }

        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    private function getRating(array $data): array
    {
        $ratingData = [];
        $rating = $this->crawler->filter(".review-main > ul.reset > li > span");

        /** @var DOMElement $item */
        foreach ($rating as $item) {
            $ratingSubjectNode = $item->getElementsByTagName('span')->item(1);

            if ($ratingSubjectNode == null) {
                throw new InviaParsingException('Rating parsing error');
            }

            $ratingSubject = $this->clearFromEscapes($ratingSubjectNode->textContent);

            $ratingValueNode = $item->getElementsByTagName('strong')->item(0);

            if ($ratingValueNode == null) {
                throw new InviaParsingException('Rating parsing error');
            }

            $ratingValue = $this->clearFromEscapes($ratingValueNode->textContent);

            $ratingData[$ratingSubject] = $ratingValue;
        }

        $data['accommodationRating'] = $ratingData['Ubytování'];
        $data['foodRating'] = $ratingData['Strava'];
        $data['surroundingsRating'] = $ratingData['Okolí'];
        $data['priceRating'] = $ratingData['Cena'];

        return $data;
    }

    /**
     * @param string $string
     * @return string
     */
    private function clearFromEscapes(string $string): string
    {
        return str_replace(["\n", "\t"], '', $string);
    }

    /**
     * @return array
     */
    private function getPictures(): array
    {
        $i = 0;
        $pictures = [];
        $pictureElements = $this->crawler->filter('a[rel="hotel-photo"]');

        /** @var DOMElement $element */
        foreach ($pictureElements as $element) {
            $pictures[] = $element->getAttribute('href');
            if (++$i == 5) {
                break;
            }
        }

        return $pictures;
    }
}
