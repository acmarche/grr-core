<?php
/**
 * This file is part of grr5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 21/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Contrat\Entity;

interface SettingEntityInterface
{
    public function getId(): ?int;

    public function getName(): string;

    public function getValue(): string;

    public function setValue(string $value): void;

    public function setName(string $name): void;

    public function getRequired(): bool;

    public function setRequired(bool $required): void;
}
