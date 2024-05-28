<?php

namespace Rramacciani\Jwt;

use Rramacciani\Jwt\Algorithm;
use Rramacciani\Jwt\Claim;
use Rramacciani\Jwt\Encoding;
use Rramacciani\Jwt\Encryption;
use Rramacciani\Jwt\Exception;
use Rramacciani\Jwt\HeaderParameter;
use Rramacciani\Jwt\Serialization;
use Rramacciani\Jwt\Signature;
use Rramacciani\Jwt\Verification;

class Jwt
{
    /**
     * @var Encoding\EncoderInterface
     */
    private $encoder;

    public function __construct()
    {
        $this->encoder = new Encoding\Base64();
    }

    /**
     * @param string $jwt
     * @return Token
     */
    public function deserialize($jwt)
    {
        $serialization = new Serialization\Compact(
            $this->encoder,
            new HeaderParameter\Factory(),
            new Claim\Factory()
        );

        return $serialization->deserialize($jwt);
    }

    /**
     * @param Token                          $token
     * @param Encryption\EncryptionInterface $encryption
     * @return string
     */
    public function serialize(Token $token, Encryption\EncryptionInterface $encryption)
    {
        $this->sign($token, $encryption);

        $serialization = new Serialization\Compact(
            $this->encoder,
            new HeaderParameter\Factory(),
            new Claim\Factory()
        );

        return $serialization->serialize($token);
    }

    /**
     * @param Token                          $token
     * @param Encryption\EncryptionInterface $encryption
     */
    public function sign(Token $token, Encryption\EncryptionInterface $encryption)
    {
        $signer = new Signature\Jws($encryption, $this->encoder);

        $signer->sign($token);
    }

    /**
     * @param Verification\Context $context
     * @return Verification\VerifierInterface[]
     */
    protected function getVerifiers(Verification\Context $context)
    {
        return [
            new Verification\EncryptionVerifier($context->getEncryption(), $this->encoder),
            new Verification\AudienceVerifier($context->getAudience()),
            new Verification\ExpirationVerifier(),
            new Verification\IssuerVerifier($context->getIssuer()),
            new Verification\SubjectVerifier($context->getSubject()),
            new Verification\NotBeforeVerifier(),
        ];
    }

    /**
     * @param Token                $token
     * @param Verification\Context $context
     * @return bool
     */
    public function verify(Token $token, Verification\Context $context)
    {
        foreach ($this->getVerifiers($context) as $verifier) {
            $verifier->verify($token);
        }

        return true;
    }
}
