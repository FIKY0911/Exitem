<?php

namespace App\Repositories\Contracts;

Interface OrderRepositoryInterface
{
    public function createTransaction(array $data);
    public function findByTrxIdAndPhoneNumber($bookingTrxId, $phoneNumber);
    public function saveToSession(array $data);
    public function updateSessionData(array $data);
    public function getOrderDataFromSession();
}