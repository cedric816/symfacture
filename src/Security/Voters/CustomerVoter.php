<?php

namespace App\Security\Voters;

use App\Entity\User\Customer;
use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/** doc:https://github.com/phpstan/phpstan/discussions/9174
 * @phpstan-extends Voter<'view', Customer>
 */
class CustomerVoter extends Voter
{
    public const VIEW = 'view';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::VIEW])) {
            return false;
        }

        if (!$subject instanceof Customer) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /**
         * @var Customer $customer
         */
        $customer = $subject;

        return match($attribute) {
            self::VIEW => $this->canView($customer, $user)
        };
    }

    private function canView(Customer $customer, User $user): bool
    {
        return $customer->getProfessionals()->contains($user);
    }
}
