<?php
/**
 * MailFilter
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class MailFilter extends AFilter
{

    /**
     * fio
     *
     * @var string
     */
    public $fio;

    /**
     * phone
     *
     * @var string
     */
    public $phone;

    /**
     * address
     *
     * @var string
     */
    public $address;
    
    public $orderType;
    
    public $weightString;
    
    public $materialName;
    
    public $cost;
    
    public $totalCost;
    
    public $technicType;
    
    public $technicName;
    
    public $price;

    /**
     * rules
     *
     * @return array
    **/
    public function rules()
    {
        return array(
            array('fio,phone,address,orderType,weightString,materialName,cost,totalCost,technicType,technicName,price', 'VText'),
            array('fio,phone,address,orderType', 'required')
        );
    }



}
