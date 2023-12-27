<?php

 declare(strict_types=1);

 namespace App\Services;

use App\Exceptions\CustomersExceptions;
use App\Helpers\Translator;
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

        $this->checkEmpty($customers, Translator::LIST_ERROR);

        return $customers;
    }

    public function saveCustomer(array $data): object
    {
        $customer = $this->customerRepository->save($data);

        $this->checkEmpty($customer, Translator::CREATE_ERROR);

        return $customer;
    }

    public function getCustomerById(int $id): object
    {
        $customer = $this->customerRepository->getById($id);

        $this->checkEmpty($customer, Translator::GET_ERROR);

        return $customer;
    }

    public function updateCustomer(array $data, int $id): object
    {
        $customer = $this->customerRepository->update($data, $id);

        $this->checkEmpty($customer, Translator::UPDATE_ERROR);

        return $customer;
    }

    public function deleteCustomer(int $id): string
    {
        $message = $this->customerRepository->delete($id);

        $this->checkEmpty($message, Translator::DELETE_ERROR);

        return $message;
    }

    private function checkEmpty($data, string $errorMessaage): void
    {
        if (empty($data)) {
            throw new CustomersExceptions($errorMessaage);
        }
    }
 }
 