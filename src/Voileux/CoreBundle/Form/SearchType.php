<?php
/**
 * SearchType.php
 *
 * Created By: jonathan
 * Date: 5/1/13
 * Time: 10:11 PM
 */

namespace Voileux\CoreBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('location', 'text', array(
                'required' => true,
            ))
            ->add('dateFrom', 'text', array(
                'required' => true,
            ))
            ->add('dateTo', 'text', array(
                'required' => true,
            ))
            ->add('persons', 'choice', array(
                'required' => true,
                'choices'   => array(
                    '1' => '1 personne',
                    '2' => '2 personnes',
                    '3' => '3 personnes',
                    '4' => '4 personnes',
                    '5' => '5 personnes',
                    '6' => '6 personnes',
                    '7' => '7 personnes',
                    '8' => '8 personnes',
                ),
            ))
            ->add('email', 'email', array(
                'required' => true,
            ))

        ;

    }

    public function getName()
    {
        return 'search';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
//            'validation_groups' => 'VoileuxSearch',
        );
    }
}