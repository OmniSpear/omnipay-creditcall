<?php

namespace Omnipay\Creditcall\Message;

use Omnipay\Tests\TestCase;

class DirectResponseTest extends TestCase
{
    public function testDirectAuthorizeSuccess()
    {
        // same as in DirectGatewayTest
        $httpResponse = $this->getMockHttpResponse('DirectAuthorizeSuccess.txt');
        $xml =  simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new DirectResponse($this->getMockRequest(), $xml);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('6f3b812a-dafa-e311-983c-00505692354f', $response->getTransactionReference());
        $this->assertSame(array(), $response->getMessage());

        $this->assertSame('a4f483ca-55fc-e311-8ca6-001422187e37', $response->getCardReference());
        $this->assertSame('qo3tCvArxWUxsCONcIWGyHUhXKs=', $response->getCardHash());
    }

}
