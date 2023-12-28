<?php

 declare(strict_types=1);

 namespace App\Services;

use App\Exceptions\CustomersExceptions;
use App\Helpers\StatusMessage;
use App\Repositories\CustomerRepository;

 class CustomerService
 {
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomers(array $filters): LengthAwarePaginator
    {
        $customers = $this->customerRepository->getAll($filters);

        $this->checkEmpty($customers, StatusMessage::LIST_ERROR);

        return $customers;
    }

    public function saveCustomer(array $data): object
    {
        $customer = $this->customerRepository->save($data);

        $this->checkEmpty($customer, StatusMessage::CREATE_ERROR);

        return $customer;
    }

    public function getCustomerById(int $id): object
    {
        $customer = $this->customerRepository->getById($id);

        $this->checkEmpty($customer, StatusMessage::GET_ERROR);

        return $customer;
    }

    public function updateCustomer(array $data, int $id): object
    {
        $customer = $this->customerRepository->update($data, $id);

        $this->checkEmpty($customer, StatusMessage::UPDATE_ERROR);

        return $customer;
    }

    public function deleteCustomer(int $id): string
    {
        $message = $this->customerRepository->delete($id);

        $this->checkEmpty($message, StatusMessage::DELETE_ERROR);

        return $message;
    }

    private function checkEmpty($data, string $errorMessaage): void
    {
        if (empty($data)) {
            throw new CustomersExceptions($errorMessaage);
        }
    }
 }
 