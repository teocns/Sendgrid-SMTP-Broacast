<?php


/*const CAPTCHA_PUBLIC = '6Le8uO8UAAAAAAp0XaTpcIyhy6HQdWN9FCztIK6a';
const CAPTCHA_SECRET = '6Le8uO8UAAAAAK-DT6QpM1wLE8aAas0kT04lg4wk';*/

const POP3_SERVERS=[
    "gmail"=>"pop.gmail.com",
    "outlook"=>"pop3.live.com",
    "hotmail"=>"pop3.live.com",
    "office365"=>"outlook.office365.com",
    "yahoo"=>"pop.mail.yahoo.com",
    "yahoo.co.uk"=>"pop.mail.yahoo.co.uk",
    "yahoo_plus"=>"plus.pop.mail.yahoo.com",
    "yahoo_au/nz"=>"pop.mail.yahoo.com.au",
    "aol"=>"pop.aol.com",
    "at&t"=>"pop.att.yahoo.com",
    "gmx.com"=>"pop.gmx.com",
    "mail.com"=>"pop.mail.com",
    "zoho"=>"pop.zoho.com",
    "rediffmail"=>"pop.rediffmailpro.com",
    "onet.pl"=>"pop.poczta.onet.pl",
    "mail.ru"=>"pop.mail.ru"
];


/* Referrals */

const REFERRAL_EARNING_PERCENTAGE = 0.35;


/*BACKEND SCRIPT*/
const POP3_FETCH_MINIMUM_DELAY = 180 ; // Seconds
const APPEAL_PROCESS_TIMEOUT = 604800; // If no update has been received for 7 days then lockdown.


/*SMTP*/


const SMTP_PASSWORD ='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';

const SMTP_FROM = "no-reply@appealbot.net";
const SMPT_FROM_NAME = "AppealBot";



/*PAYPAL */

const COINBASE_API_KEY = "a0f0468b-9367-4c85-a625-09cefcf3b54a";
/*const PAYPAL_CLIENT_ID = 'AZBIcw7skSwYlE7I3mlorwofYASZb3FwwQ6TsDxMAMRJUg-l8AAQDwaRW-eHEW-hGMaV5WZdCePLzwp0';*/
const PAYPAL_CLIENT_ID = 'ARi51kwCsz1AXFl5DXIY3v4LE8m_UccmmsItPCN22G6S4Yfz1DIYytLfCKbiDoynJHdmFmW8hFP6yhEP';
/*const PAYPAL_SECRET_ID = 'EBJ_N2U1iuhmKlfIuK6wCTwtxm94e6FCrfckE3Mp870Ulqsqc2VqcqRWm4fziAIE-4EL445tcaZhrVcn';*/
const PAYPAL_SECRET_ID = 'EHEjaO94dP51A5B16wQiBxUhHU-IjTgEMae00XRW8Kdyyg03L1b19Tt7hkVF3uFR_yX7hodyH41s6Wlf';

const PAYPAL_CHECKOUT_RETURNURL = "https://appealbot.net/";



/*TRANSFERWISE*/

const TRANSFERWISE_EMAIL = "pay@packetcut.com";
const TRANSFERWISE_NAME = "Packetcut";

/*STRIPE*/

const STRIPE_API_SECRET = 'sk_live_1VD4OH9IN1dOqDt5TetxT0sf00uulEc5ag';
const STRIPE_PUBLIC_KEY = 'pk_live_uHKRHDf5zznEks5SgbdVKBSv00SdF7MA4M';


const STRIPE_DEV_PUBLIC_KEY = 'pk_test_b2mSgiNv8LNdzXFEAxUE2ixY009FswVMKd';
const STRIPE_DEV_API_SECRET = 'sk_test_iGEgWeZ7taF3bTRSKoGegRRm00jjUaf5Qx';


/* PRICINGS */

const MONTHLY_PRICE_ONE = 9.90; // 3 ACCOUNTS
const MONTHLY_PRICE_TWO = 17.90; // 20 ACCOUNTS
const MONTHLY_PRICE_THREE = 27.90; // 50 ACCOUNTS


/*TRANSACTIONS*/

const TRANSACTION_SUBSCRIPTION_PRICE = 19.95;
const TRANSACTION_SLOT_DAILY_PRICE = 0.03;








/*TIMINGS*/
const SUBSCRIPTION_DURATION = 2592000; // one month



const PAYMENT_METHODS = [
    'coinbase',
    'stripe',
    'gpay'
];






