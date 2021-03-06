<?php


namespace App\Form;


use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditProfile extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
//            ->add('datenaissance', DateType::class,datepicker::class)


//            ->add("username", TextType::class, ["label" => $this->translator->trans('backend.user.username')])
            ->add('username',null,["label"=>'Retapez votre nom ','required'=>true,'constraints'=>[
                new Length([
                    'min' => 5,
                    'max' => 15,
                    'exactMessage'=>'Username entre 5 et 15 caractères',
                ]),]])
//            ->add("email", EmailType::class)

            ->add('nomComplet',null,["label"=>'Retapez votre nom Complet ','required'=>true,'constraints'=>[
                new Length([
                    'min' => 3,
                    'max' => 20,
                    'exactMessage'=>'Nom entre 3 et 20 caractères',
                ]),]])
            ->add('email',EmailType::class,["label"=>"Retapez votre adresse e-mail",'required'=>true,'constraints'=>[
                new Email(['mode' => 'strict']),
            ]])
            ->add('numeroTel',IntegerType::class,["label"=>'Retapez votre numéro de Téléphone : ','required'=>true, 'constraints'=>[
                new Length([
                    'min' => 8,
                    'max' => 8,
                    'exactMessage'=>'Le numéro de téléphone doit contenir exactement {{ limit }}  chiffres',
                ]),]])
            ->add('lienFbk',null,["label"=>'Retapez votre lien Facebook ','required'=>false,'constraints'=>[
                new Length([
                    'min' => 10,

                    'exactMessage'=>'taper votre lien facebook correctement',
                ]),]])
            ->add('lienInstagram',null,["label"=>'Retapez votre lien Instagram ','required'=>false,'constraints'=>[
                new Length([
                    'min' => 10,

                    'exactMessage'=>'taper votre lien instagram correctement',
                ]),]])
//            ->add("nomComplet", TextType::class, ["label" => $this->translator->trans('backend.user.name')])
//            ->add("justpassword", TextType::class, [
//                "label" => $this->translator->trans('backend.user.password'),
//                "required" => true,
//                "mapped" => false,
//                "constraints" => [
//                    new NotBlank(["message" => $this->translator->trans('backend.global.must_not_be_empty')])
//                ]
//            ]);
//            ->add('justpassword', RepeatedType::class,[
//                'type' => PasswordType::class,
//                "label" => $this->translator->trans('backend.user.password'),
//                "required" => true,
//                "mapped" => false,
//                "constraints" => [
//                    new NotBlank(["message" => $this->translator->trans('backend.global.must_not_be_empty')])
//                ],
//
//                'first_options' => array('label' => 'Mot de passe'),
//                'second_options' => array('label' => 'Confirmation du mot de passe'),
//            ])

//            ->add('nationalite',null,["label"=>'Tapez votre adresse ','required'=>true,'constraints'=>[
//                new Length([
//                    'min' => 8,
//                    'max' => 45,
//                    'exactMessage'=>'Adresse très courte',
//                ]),]])
            ->add('logo', FileType::class, [
                'label' => 'Rechargez votre image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5120k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 's\'il vous plait chargez une image de type jpeg ou png. ',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
