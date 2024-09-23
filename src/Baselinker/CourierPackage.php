<?php

declare(strict_types=1);

namespace Baselinker;

/**
 * Class CourierPackage
 * @courierpackage Baselinker
 */
class CourierPackage
{
    private string $senderCompany;
    private string $senderFullname;
    private string $senderAddress;
    private string $senderCity;
    private string $senderPostalcode;
    private string $senderEmail;
    private string $senderPhone;
    private string $deliveryCompany;
    private string $deliveryFullname;
    private string $deliveryAddress;
    private string $deliveryCity;
    private string $deliveryPostalcode;
    private string $deliveryCountry;
    private string $deliveryEmail;
    private string $deliveryPhone;
    private array $params;

    public function __construct(
        string $senderCompany = '',
        string $senderFullname = '',
        string $senderAddress = '',
        string $senderCity = '',
        string $senderPostalcode = '',
        string $senderEmail = '',
        string $senderPhone = '',
        string $deliveryCompany = '',
        string $deliveryFullname = '',
        string $deliveryAddress = '',
        string $deliveryCity = '',
        string $deliveryPostalcode = '',
        string $deliveryCountry = '',
        string $deliveryEmail = '',
        string $deliveryPhone = '',
        array $params = []
    ) {
        $this->senderCompany = $senderCompany;
        $this->senderFullname = $senderFullname;
        $this->senderAddress = $senderAddress;
        $this->senderCity = $senderCity;
        $this->senderPostalcode = $senderPostalcode;
        $this->senderEmail = $senderEmail;
        $this->senderPhone = $senderPhone;
        $this->deliveryCompany = $deliveryCompany;
        $this->deliveryFullname = $deliveryFullname;
        $this->deliveryAddress = $deliveryAddress;
        $this->deliveryCity = $deliveryCity;
        $this->deliveryPostalcode = $deliveryPostalcode;
        $this->deliveryCountry = $deliveryCountry;
        $this->deliveryEmail = $deliveryEmail;
        $this->deliveryPhone = $deliveryPhone;
        $this->params = $params;
    }

    // Setters
    public function setSenderCompany(string $senderCompany): void
    {
        $this->senderCompany = $senderCompany;
    }

    public function setSenderAddress(string $senderAddress): void
    {
        $this->senderAddress = $senderAddress;
    }

    public function setSenderFullname(string $senderFullname): void
    {
        $this->senderFullname = $senderFullname;
    }

    public function setSenderCity(string $senderCity): void
    {
        $this->senderCity = $senderCity;
    }

    public function setSenderPostalcode(string $senderPostalcode): void
    {
        $this->senderPostalcode = $senderPostalcode;
    }

    public function setSenderEmail(string $senderEmail): void
    {
        $this->senderEmail = $senderEmail;
    }

    public function setSenderPhone(string $senderPhone): void
    {
        $this->senderPhone = $senderPhone;
    }

    public function setDeliveryCompany(string $deliveryCompany): void
    {
        $this->deliveryCompany = $deliveryCompany;
    }

    public function setDeliveryFullname(string $deliveryFullname): void
    {
        $this->deliveryFullname = $deliveryFullname;
    }

    public function setDeliveryAddress(string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    public function setDeliveryCity(string $deliveryCity): void
    {
        $this->deliveryCity = $deliveryCity;
    }

    public function setDeliveryPostalcode(string $deliveryPostalcode): void
    {
        $this->deliveryPostalcode = $deliveryPostalcode;
    }

    public function setDeliveryCountry(string $deliveryCountry): void
    {
        $this->deliveryCountry = $deliveryCountry;
    }

    public function setDeliveryEmail(string $deliveryEmail): void
    {
        $this->deliveryEmail = $deliveryEmail;
    }

    public function setDeliveryPhone(string $deliveryPhone): void
    {
        $this->deliveryPhone = $deliveryPhone;
    }

    public function setApiKey(string $apiKey): void
    {
        $this->params['api_key'] = $apiKey;
    }

    public function setLabelFormat(string $labelFormat): void
    {
        $this->params['label_format'] = $labelFormat;
    }

    public function setService(string $service): void
    {
        $this->params['service'] = $service;
    }

    // Getters
    public function getSenderCompany(): string
    {
        return $this->senderCompany;
    }

    public function getSenderFullname(): string
    {
        return $this->senderFullname;
    }

    public function getSenderAddress(): string
    {
        return $this->senderAddress;
    }

    public function getSenderCity(): string
    {
        return $this->senderCity;
    }

    public function getSenderPostalcode(): string
    {
        return $this->senderPostalcode;
    }

    public function getSenderEmail(): string
    {
        return $this->senderEmail;
    }

    public function getSenderPhone(): string
    {
        return $this->senderPhone;
    }

    public function getDeliveryCompany(): string
    {
        return $this->deliveryCompany;
    }

    public function getDeliveryFullname(): string
    {
        return $this->deliveryFullname;
    }

    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    public function getDeliveryCity(): string
    {
        return $this->deliveryCity;
    }

    public function getDeliveryPostalcode(): string
    {
        return $this->deliveryPostalcode;
    }

    public function getDeliveryCountry(): string
    {
        return $this->deliveryCountry;
    }

    public function getDeliveryEmail(): string
    {
        return $this->deliveryEmail;
    }

    public function getDeliveryPhone(): string
    {
        return $this->deliveryPhone;
    }

    public function getApiKey(): string
    {
        return $this->params['api_key'] ?? '';
    }

    public function getLabelFormat(): string
    {
        return $this->params['label_format'] ?? '';
    }

    public function getService(): string
    {
        return $this->params['service'] ?? '';
    }

    /**
     * Create a new shipment package.
     *
     * This method prepares and sends a request to create a shipment package
     * using the provided order and API parameters. It validates the required
     * fields and handles API errors appropriately.
     *
     * @param array $order Order details including sender and delivery information.
     * @param array $params API parameters such as API key and service.
     * @return string The tracking number of the created shipment.
     * @throws InvalidArgumentException If required fields are missing or invalid.
     * @throws RuntimeException If there is a cURL error or an error from the API.
     */
    public function newPackage(array $order, array $params): string
    {
        if (empty($order) || empty($params)) {
            throw new \InvalidArgumentException('One of the parameters of the "newPackage" method is an empty array.', 1);
        }

        $requiredFields = [
            'delivery_fullname' => 'Delivery fullname is required.',
            'delivery_address' => 'Delivery address is required.',
            'delivery_city' => 'Delivery city is required.',
            'delivery_country' => 'Delivery country is required.',
            'delivery_phone' => 'Delivery phone is required.',
            'delivery_email' => 'Delivery e-mail is required.',
        ];

        foreach ($requiredFields as $field => $errorMessage) {
            if (empty($order[$field])) {
                throw new \InvalidArgumentException($errorMessage, 1);
            }
        }

        $addressesToCheck = [
            $order['sender_address'],
            $order['delivery_address'],
        ];

        foreach ($addressesToCheck as $address) {
            if (strlen($address) > 150) {
                throw new \InvalidArgumentException('Address is too long. Maximum length is 150 characters.');
            }
        }

        $this->setSenderCompany(trim($order['sender_company'] ?? ''));
        $this->setSenderFullname(trim($order['sender_fullname'] ?? ''));
        $this->setSenderAddress(trim($order['sender_address'] ?? ''));
        $this->setSenderCity(trim($order['sender_city'] ?? ''));
        $this->setSenderPostalcode(trim($order['sender_postalcode'] ?? ''));
        $this->setSenderEmail(trim($order['sender_email'] ?? ''));
        $this->setSenderPhone(trim($order['sender_phone'] ?? ''));
        $this->setDeliveryCompany(trim($order['delivery_company'] ?? ''));
        $this->setDeliveryFullname(trim($order['delivery_fullname'] ?? ''));
        $this->setDeliveryAddress(trim($order['delivery_address'] ?? ''));
        $this->setDeliveryCity(trim($order['delivery_city'] ?? ''));
        $this->setDeliveryPostalcode(trim($order['delivery_postalcode'] ?? ''));
        $this->setDeliveryCountry(trim($order['delivery_country'] ?? ''));
        $this->setDeliveryEmail(trim($order['delivery_email'] ?? ''));
        $this->setDeliveryPhone(trim($order['delivery_phone'] ?? ''));
        $this->setApiKey(trim($params['api_key'] ?? ''));
        $this->setLabelFormat(trim($params['label_format'] ?? ''));
        $this->setService(trim($params['service'] ?? ''));

        $fullSenderAddress = $this->getSenderAddress();
        $fullDeliveryAddress = $this->getDeliveryAddress();

        $senderAddressLines = explode(',', $fullSenderAddress);
        $deliveryAddressLines = explode(',', $fullDeliveryAddress);

        $senderAddressLine1 = isset($senderAddressLines[0]) ? substr(trim($senderAddressLines[0]), 0, 40) : '';
        $senderAddressLine2 = isset($senderAddressLines[1]) ? substr(trim($senderAddressLines[1]), 0, 40) : '';
        $senderAddressLine3 = isset($senderAddressLines[2]) ? substr(trim($senderAddressLines[2]), 0, 40) : '';

        $deliveryAddressLine1 = isset($deliveryAddressLines[0]) ? substr(trim($deliveryAddressLines[0]), 0, 40) : '';
        $deliveryAddressLine2 = isset($deliveryAddressLines[1]) ? substr(trim($deliveryAddressLines[1]), 0, 40) : '';
        $deliveryAddressLine3 = isset($deliveryAddressLines[2]) ? substr(trim($deliveryAddressLines[2]), 0, 40) : '';

        $reference = $this->generateReference();

        $shipmentData = [
            'Apikey' => $this->getApiKey(),
            'Command' => 'OrderShipment',
            'Shipment' => [
                'LabelFormat' => 'PDF',
                'ShipperReference' => $reference,
                'Service' => $this->getService(),
                'ConsignorAddress' => [
                    'Name' => $this->getSenderFullname(),
                    'Company' => $this->getSenderCompany(),
                    'AddressLine1' => $senderAddressLine1,
                    'AddressLine2' => $senderAddressLine2,
                    'AddressLine3' => $senderAddressLine3,
                    'City' => $this->getSenderCity(),
                    'Zip' => $this->getSenderPostalcode(),
                    'Country' => $this->getDeliveryCountry(),
                    'Phone' => $this->getSenderPhone(),
                    'Email' => $this->getSenderEmail(),
                ],
                'ConsigneeAddress' => [
                    'Name' => $this->getDeliveryFullname(),
                    'Company' => $this->getDeliveryCompany(),
                    'AddressLine1' => $deliveryAddressLine1,
                    'AddressLine2' => $deliveryAddressLine2,
                    'AddressLine3' => $deliveryAddressLine3,
                    'City' => $this->getDeliveryCity(),
                    'Zip' => $this->getDeliveryPostalcode(),
                    'Country' => $this->getDeliveryCountry(),
                    'Phone' => $this->getDeliveryPhone(),
                    'Email' => $this->getDeliveryEmail(),
                ],
            ],
        ];

        $ch = curl_init('https://mtapi.net/?testMode=1');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($shipmentData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \RuntimeException('cURL error: ' . curl_error($ch));
        }

        curl_close($ch);

        $responseData = json_decode($response, true);
        if (isset($responseData['ErrorLevel']) && $responseData['ErrorLevel'] === 0) {
            echo "Shipment created successfully. Tracking Number: " . $responseData['Shipment']['TrackingNumber'];
            return (string) $responseData['Shipment']['TrackingNumber'];
        } else {
            echo "Error creating shipment: " . $responseData['Error'] . ' ';
        }
    }

    /**
     * Fetch and display the shipping label for the given tracking number.
     *
     * @param string $trackingNumber The tracking number of the package.
     * @param array $params Optional parameters, such as API key.
     * @throws InvalidArgumentException If the tracking number is empty.
     * @throws RuntimeException If there is a cURL error or an error from the API.
     */
    public function packagePDF(string $trackingNumber, array $params = []): void
    {
        if (empty($trackingNumber)) {
            throw new \InvalidArgumentException('You need tracking number.', 1);
        }

        $shipmentData = [
            'Apikey' => empty($this->getApiKey()) ? $params['api_key'] : $this->getApiKey(),
            'Command' => 'GetShipmentLabel',
            'Shipment' => [
                'LabelFormat' => 'PDF',
                'TrackingNumber' => $trackingNumber,
            ],
        ];

        $ch = curl_init('https://mtapi.net/?testMode=1');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($shipmentData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \RuntimeException('cURL error: ' . curl_error($ch));
        }
        curl_close($ch);

        $responseData = json_decode($response, true);
        if (isset($responseData['ErrorLevel']) && $responseData['ErrorLevel'] === 0) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="label.pdf"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            echo base64_decode($responseData['Shipment']['LabelImage']);
        } else {
            echo "Error fetching shipment label: " . $responseData['Error'];
        }
    }

    public function generateReference()
    {
        $datePart = date('Ymd');
        $uniqueId = mt_rand(1000, 9999);
        return "Reference_$datePart-$uniqueId";
    }
}