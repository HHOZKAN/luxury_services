<?php

namespace App\Form;

use App\Entity\Candidat;
use DateTime;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('genre', ChoiceType::class, [
                'label' => 'genre',
                'choices' => [
                    'Choose an option' => null,
                    'Homme' => "Homme",
                    'Femme' => 'Femme',
                ],
                'row_attr' => [
                    'class' => 'input-field',
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'nom',
                'row_attr' => [
                    'class' => 'input-field',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'first_name',
                    'name' => 'first_name',
                    'type' => 'text',
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'prénom',
                'row_attr' => [
                    'class' => 'input-field',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'last_name',
                    'name' => 'last_name',
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => 'adresse',
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'address',
                    'name' => 'address',
                    'type' => 'text',
                ]
            ])
            ->add('pays', TextType::class, [
                'label' => 'pays',
                'row_attr' => [
                    'class' => 'input-field',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'pays',
                    'name' => 'pays'
                ]
            ])
            ->add('nationalite', TextType::class, [
                'label' => 'nationalite',
                'row_attr' => [
                    'class' => 'input-field',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'nationality',
                    'name' => 'nationality'
                ]
            ])
            // ->add('ispassport')
            ->add('date_naissance', DateType::class, [
                'input' => 'datetime_immutable',
                // 'html5' => false,
                'widget' => 'single_text' ,
                'label' => 'Date de Naissance',
                'row_attr' => [
                    'class' => 'input-field',
                ],
                'attr' => [
                    'class' => 'datepicker',
                    'id' => 'birth_date',
                    'name' => 'birth_date',
                ]
            ])
            ->add('lieu_naissance', TextType::class, [
                'label' => 'Lieu de naissance',
                'row_attr' => [
                    'class' => 'input-field',
                ],
                'attr' => [
                    'id' => 'birth_place',
                    'name' => 'birth_place',
                ]
            ])
            // ->add('email')
            // ->add('password')
            // ->add('disponibilite')
            ->add('job_categorie', ChoiceType::class, [
                'choices' => [
                    'Choose an option' => null,
                    'Finance' => 'Finance',
                    'Santé' => 'Santé',
                    'Tech' => 'Tech',
                    'Education' => 'Education',
                ],
                'choice_attr' => [
                    'class' => 'g-3'
                ],
                'label' => 'Catégories de job',
                'row_attr' => [
                    'class' => 'input-field',
                    'style' => 'margin-top: 5px;',
                ],
            ])
            ->add('experience', ChoiceType::class, [
                'choices' => [
                    'Choose an option' => null,
                    '0-6 month' => '0-6 month',
                    '6 month - 1 year' => '6 month - 1 year',
                    '1 -2 years' => '1 -2 years',
                    '2+ years' => '2+ years',
                ],
                'label' => 'Experience professionnelle',
                'row_attr' => [
                    'class' => 'input-field',
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'materialize-textarea',
                    'id'=> 'description',
                    'name' => 'description',
                    'cols' => '50',
                    'rows' => '10'],
                'label' => 'Décrivez-vous...',
                'row_attr' => [
                    'class' => 'input-field',
            ]
                ])
            ->add('passport', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'id' => 'passport',
                    'size' => '200000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'passport',
            ]
            ])
            ->add('cv', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'id' => 'passport',
                    'size' => '200000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'passport',
                ]
            ])
            ->add('profil_picture' , FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'id' => 'photo',
                    'size' => '200000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'photo',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
