<?php

namespace Grr\Core\Setting\General;

use Symfony\Component\Form\FormInterface;

interface SettingGeneralInterface
{
    /**
     * Nom de la clef du paramètre encodé dans sql.
     */
    public function name(): string;

    /**
     * Nom de l'index du service stocké dans le container de sf
     * @return string
     */
    public static function getDefaultIndexName(): string;

    /**
     * Valeur encodé dans sql ou autre source.
     *
     * @return mixed
     */
    public function value();

    /**
     * Label du champ formulaire.
     */
    public function label(): string;

    /**
     * Aide du champ formulaire.
     */
    public function help(): string;

    /**
     * Valeur par defaut si aucune valeur définie par l'utilisateur.
     *
     * @return mixed
     */
    public function defaultValue();

    /**
     * Ordre d'affichage dans le formulaire.
     */
    public function displayOrder(): int;

    public function isRequired(): bool;

    /**
     * Définition du champ dans le formulaire.
     *
     * @return mixed
     */
    public function addFieldForm(FormInterface $form);

    /**
     * Affichage html pour l'utilisateur.
     */
    public function renderValue(): string;

    /**
     * Modifie la valeur avant de l'enregistrer dans la table sql.
     */
    public function bindValue($value): ?string;
}
