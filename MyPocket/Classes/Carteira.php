<?php

declare(strict_types=1);

require_once 'Receita.php';
require_once 'Despesa.php';

class Carteira
{
    private float $saldo = 0;

    private array $transacoes = [];

    public function adicionarTransacao(
        Transacao $transacao
    ): void {

        if ($transacao instanceof Receita) {

            $this->saldo += $transacao->getValor();

        } elseif ($transacao instanceof Despesa) {

            if ($transacao->getValor() > $this->saldo) {

                throw new Exception(
                    'Saldo insuficiente para realizar esta despesa.'
                );
            }

            $this->saldo -= $transacao->getValor();
        }

        $this->transacoes[] = $transacao;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function getTransacoes(): array
    {
        return $this->transacoes;
    }
}