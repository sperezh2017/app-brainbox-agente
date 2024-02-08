<?php

namespace App\Form;

use App\Entity\CatEntidad;
use App\Entity\CatMes;
use App\Entity\CatProceso;
use App\Entity\CatRecurrencia;
use App\Entity\CliTemplate;
use App\Entity\TipoGuia;
use App\Entity\TipoProceso;
use App\Entity\VariableInicio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatProcesoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prodescripcion')
            ->add('dia')
            ->add('proantdias')
            ->add('inactivo')
            ->add('eliminar')
            ->add('diasemana')
            ->add('despues')
            ->add('habFin')
            ->add('mes', EntityType::class, [
                'class' => CatMes::class,
'choice_label' => 'id',
            ])
            ->add('recurrencia', EntityType::class, [
                'class' => CatRecurrencia::class,
'choice_label' => 'id',
            ])
            ->add('entidad', EntityType::class, [
                'class' => CatEntidad::class,
'choice_label' => 'id',
            ])
            ->add('cliTemplates', EntityType::class, [
                'class' => CliTemplate::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('tipoGuias', EntityType::class, [
                'class' => TipoGuia::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('tipoProceso', EntityType::class, [
                'class' => TipoProceso::class,
'choice_label' => 'id',
            ])
            ->add('variableInicio', EntityType::class, [
                'class' => VariableInicio::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CatProceso::class,
        ]);
    }
}
