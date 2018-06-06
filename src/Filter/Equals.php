<?php

namespace ZF\Doctrine\Criteria\Filter;

use Doctrine\Common\Collections\Criteria;

class Equals extends AbstractFilter
{
    public function filter(Criteria $criteria, $metadata, $option)
    {
        if (isset($option['where'])) {
            if ($option['where'] === 'and') {
                $queryType = 'andWhere';
            } elseif ($option['where'] === 'or') {
                $queryType = 'orWhere';
            }
        } else {
            $queryType = 'andWhere';
        }

        $format = null;
        if (isset($option['format'])) {
            $format = $option['format'];
        }

        $value = $this->typeCastField($metadata, $option['field'], $option['value'], $format);

        $criteria->$queryType($criteria->expr()->eq($option['field'], $value));
    }
}
