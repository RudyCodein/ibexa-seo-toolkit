<?php declare(strict_types=1);

namespace Codein\eZPlatformSeoToolkit\Form\Type;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Count;
use Codein\eZPlatformSeoToolkit\Model\ContentFields;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ContentFieldsFormType.
 */
final class ContentFieldsType extends AbstractType
{
    private const CONSTRAINTS = 'constraints';
    public function buildForm(FormBuilderInterface $formBuilder, array $options): void
    {
        $formBuilder
            ->add('keyword', TextType::class)
            ->add('isPillarPage', CheckboxType::class, [
                self::CONSTRAINTS => [],
            ])
            ->add('contentTypeIdentifier', IntegerType::class, [
                self::CONSTRAINTS => [new NotBlank()],
            ])
            ->add('fields', FieldType::class, [
                self::CONSTRAINTS => [new Count([
                    'min' => 1,
                ])],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContentFields::class,
            'csrf_protection' => false,
        ]);
    }
}
