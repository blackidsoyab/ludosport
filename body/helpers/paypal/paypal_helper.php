<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Amount;
use PayPal\Api\CreditCard;
use PayPal\Api\CreditCardToken;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;

function include_paypal_setting() {
    require_once 'autoload.php';
    return true;
}

function getApiContext() {
    $apiContext = new ApiContext(new OAuthTokenCredential('Adwp7BDykk8Ic3vzBnmgqmM5dOiCsy_NMiVPKx4EqvYPBvpEfEeNAP3MB8t2', 'EHskPhAGnpSLKoAYh17NDEUOT5wIdWWJqv5BZfSErKu2Lw_F5tU9WOXgoQxC'));
    
    if (!defined('PP_CONFIG_PATH')) {
        define("PP_CONFIG_PATH", dirname(__DIR__) . '/paypal');
    }
    
    return $apiContext;
}

/**
 * Determine the baseurl of the current script.
 * Used for determining the absolute url of return and
 * cancel urls.
 * @return string
 */
function getBaseUrl() {
    
    $protocol = 'http';
    if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')) {
        $protocol.= 's';
        $protocol_port = $_SERVER['SERVER_PORT'];
    } else {
        $protocol_port = 80;
    }
    
    $host = $_SERVER['HTTP_HOST'];
    $port = $_SERVER['SERVER_PORT'];
    $request = $_SERVER['PHP_SELF'];
    return dirname($protocol . '://' . $host . ($port == $protocol_port ? '' : ':' . $port) . $request);
}

/**
 * Utility method that returns the first url of a certain
 * type. Returns empty string if no match is found
 *
 * @param array $links
 * @param string $type
 * @return string
 */
function getLink(array $links, $type) {
    foreach ($links as $link) {
        if ($link->getRel() == $type) {
            return $link->getHref();
        }
    }
    return "";
}

/**
 * Utility function to pretty print API error data
 * @param string $errorJson
 * @return string
 */
function parseApiError($errorJson) {
    $msg = '';
    
    $data = json_decode($errorJson, true);
    if (isset($data['name']) && isset($data['message'])) {
        $msg.= $data['name'] . " : " . $data['message'] . "<br/>";
    }
    if (isset($data['details'])) {
        $msg.= "<ul>";
        foreach ($data['details'] as $detail) {
            $msg.= "<li>" . $detail['field'] . " : " . $detail['issue'] . "</li>";
        }
        $msg.= "</ul>";
    }
    if ($msg == '') {
        $msg = $errorJson;
    }
    return $msg;
}

/**
 * Create a payment using the buyer's paypal
 * account as the funding instrument. Your app
 * will have to redirect the buyer to the paypal
 * website, obtain their consent to the payment
 * and subsequently execute the payment using
 * the execute API call.
 *
 * @param string $total payment amount in DDD.DD format
 * @param string $currency  3 letter ISO currency code such as 'USD'
 * @param string $paymentDesc   A description about the payment
 * @param string $returnUrl The url to which the buyer must be redirected
 *              to on successful completion of payment
 * @param string $cancelUrl The url to which the buyer must be redirected
 *              to if the payment is cancelled
 * @return \PayPal\Api\Payment
 */

function makePaymentUsingPayPal($total, $currency, $paymentDesc, $returnUrl, $cancelUrl) {
    
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");
    
    // Specify the payment amount.
    $amount = new Amount();
    $amount->setCurrency($currency);
    $amount->setTotal(number_format($total, 2));
    
    // ###Transaction
    // A transaction defines the contract of a
    // payment - what is the payment for and who
    // is fulfilling it. Transaction is created with
    // a `Payee` and `Amount` types
    $transaction = new Transaction();
    $transaction->setAmount($amount);
    $transaction->setDescription($paymentDesc);
    
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl($returnUrl);
    $redirectUrls->setCancelUrl($cancelUrl);
    
    $payment = new Payment();
    $payment->setRedirectUrls($redirectUrls);
    $payment->setIntent("sale");
    $payment->setPayer($payer);
    $payment->setTransactions(array($transaction));
    
    $payment->create(getApiContext());
    return $payment;
}

/**
 * Completes the payment once buyer approval has been
 * obtained. Used only when the payment method is 'paypal'
 *
 * @param string $paymentId id of a previously created
 *      payment that has its payment method set to 'paypal'
 *      and has been approved by the buyer.
 *
 * @param string $payerId PayerId as returned by PayPal post
 *      buyer approval.
 */
function executePayment($paymentId, $payerId) {
    
    $payment = Payment::get($paymentId, getApiContext());
    $paymentExecution = new PaymentExecution();
    $paymentExecution->setPayerId($payerId);
    $payment = $payment->execute($paymentExecution, getApiContext());
    
    return $payment;
}

function getPaymentDetails($paymentId) {
    $payment = Payment::get($paymentId, getApiContext());
    return $payment;
}
?>
