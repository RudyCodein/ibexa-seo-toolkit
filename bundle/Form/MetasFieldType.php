<?php declare(strict_types=1);

namespace Codein\eZPlatformSeoToolkit\Form;

use Codein\eZPlatformSeoToolkit\DependencyInjection\EzPlatformSeoToolkitExtension;
use Codein\eZPlatformSeoToolkit\FieldType\DynamicCollectionType;
use Codein\eZPlatformSeoToolkit\FieldType\Value;
use eZ\Publish\Core\MVC\ConfigResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MetasFieldType.
 */
final class MetasFieldType extends AbstractType
{
    /** @var ConfigResolverInterface */
    private $configResolver;

    /**
     * FormMapper constructor.
     */
    public function __construct(ConfigResolverInterface $configResolver)
    {
        $this->configResolver = $configResolver;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $metasConfig = $this->configResolver->getParameter('metas', EzPlatformSeoToolkitExtension::ALIAS)['field_type_metas'];

        $builder
            ->add('metas', DynamicCollectionType::class, [
                'meta_config' => $metasConfig,
            ])
   ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Value::class);
    }

    public function getBlockPrefix(): string
    {
        return 'codeinseo_field_type_metas';
    }
}
