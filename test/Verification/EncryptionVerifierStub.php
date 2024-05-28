<?php

namespace Rramacciani\Jwt\Verification;

use Rramacciani\Jwt\Encoding;
use Rramacciani\Jwt\Encryption;
use Rramacciani\Jwt\Signature\SignerInterface;

class EncryptionVerifierStub extends EncryptionVerifier
{
    public function __construct(
        Encryption\EncryptionInterface $encryption,
        Encoding\EncoderInterface $encoder,
        SignerInterface $signer
    ) {
        parent::__construct($encryption, $encoder);
        $this->signer = $signer;
    }
}
