<?php
// src/Form/Type/LivreType.php (début)
namespace App\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Livres;
use App\Entity\Auteurs;

    class LivreType extends AbstractType
    {
        // src/Form/Type/LivreType.php (suite)
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class);
        }

        // Ici, on défini de manière explicite le « data_class »
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
            'data_class' => Auteurs::class,
            ]);
        }
    }



?>