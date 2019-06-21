<?php

declare(strict_types = 1);

namespace App\Service\Mailer;

use App\Exception\MailNotSendException;
use App\Exception\InvalidMailerConfigurationException;

interface MailerInterface {
	/**
	 * @param array $config
	 *
	 * @throws InvalidMailerConfigurationException
	 */
	public function __construct(array $config);

	/**
	 * @param string $subject
	 * @param string $toEmail
	 * @param string $toName
	 * @param string $message
	 *
	 * @return void
	 *
	 * @throws MailNotSendException
	 */
	public function sendMail(string $subject, string $toEmail, string $toName, string $message): void;
}
