<?php

namespace Apps\Tms\Packages\Tools\Charges;

use Apps\Tms\Packages\Tools\Charges\Model\AppsTmsToolsCharges;
use System\Base\BasePackage;

class ToolsCharges extends BasePackage
{
    protected $modelToUse = AppsTmsToolsCharges::class;

    protected $packageName = 'toolscharges';

    public $toolscharges;

    public function init()
    {
        parent::init();

        return $this;
    }

    public function getChargeByName($chargeName)
    {
        if ($this->config->databasetype === 'db') {
            $params =
                [
                    'conditions'    => 'name = :name:',
                    'bind'          =>
                        [
                            'name'          => $chargeName,
                        ]
                ];
        } else {
            $params = ['conditions' => ['name', '=', $chargeName]];
        }

        $chargeArr = $this->getByParams($params);

        if ($chargeArr && count($chargeArr) > 0) {
            return $chargeArr[0];
        }

        return false;
    }

    public function addCharge($data)
    {
        if ($this->add($data)) {
            $this->addResponse('Unit of measurement added');

            return true;
        }

        $this->addResponse('Error Adding unit of measurement', 1);
    }

    public function updateCharge($data)
    {
        if ($this->update($data)) {
            $this->addResponse('Unit of measurement updated');

            return true;
        }

        $this->addResponse('Error Updating unit of measurement', 1);
    }

    public function removeCharge($data)
    {
        if ($this->remove($data['id'])) {
            $this->addResponse('Unit of measurement removed');

            return true;
        }

        $this->addResponse('Error removing unit of measurement', 1);

        return false;
    }

    public function getChargeTypes()
    {
        return
            [
                '0' =>
                    [
                        'id' => '0',
                        'name'  => 'Product'
                    ],
                '1' =>
                    [
                        'id' => '1',
                        'name'  => 'Charges'
                    ]
            ];
    }
}