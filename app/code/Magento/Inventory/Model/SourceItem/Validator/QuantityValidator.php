<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Inventory\Model\SourceItem\Validator;

use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use Magento\Inventory\Model\Source\Validator\SourceItemValidatorInterface;
use Magento\InventoryApi\Api\Data\SourceItemInterface;

/**
 * Check that quantity is valid
 */
class QuantityValidator implements SourceItemValidatorInterface
{
    /**
     * @var ValidationResultFactory
     */
    private $validationResultFactory;

    /**
     * @param ValidationResultFactory $validationResultFactory
     */
    public function __construct(ValidationResultFactory $validationResultFactory)
    {
        $this->validationResultFactory = $validationResultFactory;
    }

    /**
     * @inheritdoc
     */
    public function validate(SourceItemInterface $source): ValidationResult
    {
        $errors = [];
        if (!is_numeric($source->getQuantity())) {
            $errors[] = __(
                '"%field" should be numeric',
                ['field' => SourceItemInterface::QUANTITY]
            );
        }

        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}