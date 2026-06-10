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
            $this->addResponse('Charge added');

            return true;
        }

        $this->addResponse('Error Adding charge', 1);
    }

    public function updateCharge($data)
    {
        if ($this->update($data)) {
            $this->addResponse('Charge updated');

            return true;
        }

        $this->addResponse('Error Updating charge', 1);
    }

    public function removeCharge($data)
    {
        if ($this->remove($data['id'])) {
            $this->addResponse('Charge removed');

            return true;
        }

        $this->addResponse('Error removing charge', 1);

        return false;
    }

    public function getChargeTypes()
    {
        return
            [
                '1' =>
                    [
                        'id' => '1',
                        'name'  => 'Product'
                    ],
                '2' =>
                    [
                        'id' => '2',
                        'name'  => 'Charges'
                    ]
            ];
    }
}