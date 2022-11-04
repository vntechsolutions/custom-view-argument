<?php

namespace Drupal\custom_views_argument\Plugin\views\argument_validator;

use Drupal\path_alias\AliasManagerInterface;
use Drupal\views\Plugin\views\argument_validator\ArgumentValidatorPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Validates whether an alias is a valid node alias and transform it to the nid.
 *
 * @ViewsArgumentValidator(
 *   id = "node_alias",
 *   title = @Translation("Node ID by alias")
 * )
 */
class NodeAlias extends ArgumentValidatorPluginBase {

  /**
   * The alias manager.
   *
   * @var \Drupal\path_alias\AliasManagerInterface
   */
  protected $aliasManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, AliasManagerInterface $alias_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->aliasManager = $alias_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('path_alias.manager'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function validateArgument($argument) {
    // Prepend slash.
    $argument = '/' . ltrim($argument, '/');
    $path = $this->aliasManager->getPathByAlias($argument);

    if (preg_match('/node\/(\d+)/', $path, $matches)) {
      $this->argument->argument = $matches[1];
      return TRUE;
    }
    return FALSE;
  }

}
