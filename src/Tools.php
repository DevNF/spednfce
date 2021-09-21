<?php
namespace NFHub\SpedNfce;

use Exception;
use NFHub\Common\Tools as ToolsBase;

/**
 * Classe Tools
 *
 * Classe responsável pela implementação com a API de SpedNfce do NFHub
 *
 * @category  NFHub
 * @package   NFHub\SpedNfce\Tools
 * @author    Jefferson Moreira <jeematheus at gmail dot com>
 * @copyright 2021 NFSERVICE
 * @license   https://opensource.org/licenses/MIT MIT
 */
class Tools extends ToolsBase
{
    /**
     * Cadastra um novo certificado digital
     */
    function cadastraCertificado(string $company_cnpj, array $data, array $params = []): array
    {
        try {
            $this->setUpload(true);
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            $response = $this->post('certificates', $data, $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        } finally {
            $this->setUpload(false);
        }
    }

    /**
     * Calcula os totais de uma NFCe
     */
    function calculaNfce(string $company_cnpj, array $data, array $params = []): array
    {
        try {
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            $response = $this->post('/invoice-customers/calculate', $data, $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Transmite uma NFCe
     */
    function transmiteNfce(string $company_cnpj, array $data, array $params = []): array
    {
        try {
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            $response = $this->post('/invoice-customers', $data, $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Consulta uma NFCe
     */
    function consultaNfce(string $company_cnpj, int $id, array $params = []): array
    {
        try {
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            $response = $this->get("/invoice-customers/$id", $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Busca a DANFCE de uma NFCe
     */
    function imprimeNfce(string $company_cnpj, int $id, array $params = []): array
    {
        try {
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            $this->setDecode(false);
            $response = $this->get("/invoice-customers/$id/danfce", $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Busca o XML de uma NFCe
     */
    function xmlNfce(string $company_cnpj, int $id, array $params = []): array
    {
        try {
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            $this->setDecode(false);
            $response = $this->get("/invoice-customers/$id/xml", $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Realiza a correção de uma NFCe
     */
    function cancelNfce(string $company_cnpj, int $id, array $data, array $params = []): array
    {
        try {
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            $response = $this->post("/invoice-customers/$id/cancel", $data, $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Busca o PDF de uma Correção de NFCe
     */
    function imprimeNfceCancel(string $company_cnpj, int $id, array $params = []): array
    {
        try {
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            $this->setDecode(false);
            $response = $this->get("/invoice-customers/$id/cancel/pdf", $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Realiza a importação de xmls
     *
     * @param string $company_cnpj CNPJ da empresa que esta realizando a importação
     * @param array $xmls Array contendo os arquivos XMLs importados pela classe CURLFile
     *
     * @access public
     * @return array
     */
    function importaXml(string $company_cnpj, array $xmls, array $params  = []) :array
    {
        try {
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            if (empty($xmls)) {
                throw new Exception("É necessário enviar ao menos 1(um) arquivo XML", 1);
            }

            $data['xmls'] = $xmls;

            $this->setUpload(true);
            $response = $this->post("/invoices/import", $data, $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Gera o PDF de uma NFe com base no conteúdo de seu arquivo XML
     *
     * @param string $company_cnpj CNPJ da empresa que está gerando o PDF
     * @param string $content Conteúdo do arquivo XML em base64
     * @param array $param Parametros adicionais para a requisição
     *
     * @access public
     * @return array
     */
    public function geraPdf(string $company_cnpj, string $content, array $params = []) :array
    {
        try {
            $headers = [
                "company-cnpj: $company_cnpj"
            ];

            $data = [
                'xml' => $content
            ];

            $this->setDecode(false);
            $response = $this->post("/tools/printSefaz", $data, $params, $headers);

            if ($response['httpCode'] >= 200 || $response['httpCode'] <= 299) {
                return $response;
            }

            if (isset($response['body']->message)) {
                throw new Exception($response['body']->message, 1);
            }

            if (isset($response['body']->errors)) {
                throw new Exception(implode("\r\n", $response['body']->errors), 1);
            }

            throw new Exception(json_encode($response), 1);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }
}
