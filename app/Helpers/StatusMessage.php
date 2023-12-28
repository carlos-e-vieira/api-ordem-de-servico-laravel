<?php

declare(strict_types=1);

namespace App\Helpers;

final class StatusMessage
{
    public const LIST_ERROR = 'Erro ao listar todos os registros';
    public const CREATE_ERROR = 'Erro ao cadastrar os dados';
    public const GET_ERROR = 'Erro ao buscar os dados';
    public const UPDATE_ERROR = 'Erro ao atualizar os dados';
    public const GENERATE_TOKEN_ERROR = 'Erro ao gerar Token';
    public const DELETE_ERROR = 'Erro ao deletar os dados';
    public const DELETE_SUCCESS = 'Registro deletado com sucesso!';
    public const LOGOUT_SUCCESS = 'Logout realizado com sucesso!';
}
