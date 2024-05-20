<?php

namespace App\Compras\Entity;

/**
 * @todo Agregar propiedades faltantes Lada Pais, Lada,
 * Telefono, Regimen Fiscal, Uso CFDI, Comprobante Cargado 
 */
class ComprasEntity
{

  // AE.Compra
  private int $idCompra; // Id Compra
  private int $idCompraStatus; // Estatus Compra
  private string $statusES; // Estaus Compra -> AE.CompraStatus.StatusES
  private float $total; // Monto Compra
  private int $idFormaPago; // Forma Pago
  private string $formaPagoES; // Forma Pago -> AE.FormaPago.FormaPagoES
  private \DateTime $fechaCreacion; // Fecha Compra
  private ?bool $reqFactura; // Requiere Factura
  private ?bool $compraFacturada; // Compra Facturada
  private int $idVisitante; // Id Visitante
  private ?string $nombre; // Nombre -> AE.Visitante.NombreCompleto
  private ?string $email; // Email -> AE.Visitante.Email

  public function __construct(
    int $idCompra,
    int $idCompraStatus,
    string $statusES,
    float $total,
    int $idFormaPago,
    string $formaPagoES,
    string $fechaCreacion, // Era DateTime
    ?bool $reqFactura,
    ?bool $compraFacturada,
    int $idVisitante,
    ?string $nombre,
    ?string $email
  ) {
    $this->idCompra = $idCompra;
    $this->idCompraStatus = $idCompraStatus;
    $this->statusES = $statusES;
    $this->total = $total;
    $this->idFormaPago = $idFormaPago;
    $this->formaPagoES = $formaPagoES;
    $this->fechaCreacion = new \DateTime($fechaCreacion);
    $this->reqFactura = $reqFactura;
    $this->compraFacturada = $compraFacturada;
    $this->idVisitante = $idVisitante;
    $this->nombre = $nombre;
    $this->email = $email;
  }

  public function getIdCompra(): int
  {

    return $this->idCompra;
  }

  public function getIdCompraStatus(): int
  {

    return $this->idCompraStatus;
  }

  public function getStatusES(): string
  {

    return $this->statusES;
  }

  public function getTotal(): float
  {

    return $this->total;
  }

  public function getIdFormaPago(): int
  {

    return $this->idFormaPago;
  }

  public function getFormaPagoEs(): string
  {

    return $this->formaPagoES;
  }

  public function getFechaCreacion(): \DateTime
  {

    return $this->fechaCreacion;
  }

  public function getReqFactura(): bool
  {

    return $this->reqFactura;
  }

  public function getCompraFacturada(): bool
  {

    return $this->compraFacturada;
  }

  public function getIdVisitante_(): int
  {

    return $this->idVisitante;
  }

  public function getNombre(): string
  {

    return $this->nombre;
  }

  public function getEmail(): string
  {

    return $this->email;
  }

  public static function fromAssoc(array $assoc): ComprasEntity
  {

    $idCompra = $assoc['idCompra'];
    $idCompraStatus = $assoc['idCompraStatus'];
    $statusES = $assoc['StatusES'];
    $total = $assoc['Total'];
    $idFormaPago = $assoc['idFormaPago'];
    $formaPagoES = $assoc['FormaPagoES'];
    $fechaCreacion = $assoc['FechaCreacion'];
    $reqFactura = $assoc['ReqFactura'];
    $compraFacturada = $assoc['CompraFacturada'];
    $idVisitante = $assoc['idVisitante'];
    $nombre = $assoc['Nombre'];
    $email = $assoc['Email'];

    return new self(
      $idCompra,
      $idCompraStatus,
      $statusES,
      $total,
      $idFormaPago,
      $formaPagoES,
      $fechaCreacion,
      $reqFactura,
      $compraFacturada,
      $idVisitante,
      $nombre,
      $email
    );
  }

  public function toAssoc(): array
  {

    return [
      'idCompra' => $this->idCompra,
      'idCompraStatus' => $this->idCompraStatus,
      'StatusES' => $this->statusES,
      'Total' => $this->total,
      'idFormaPago' => $this->idFormaPago,
      'FormaPagoES' => $this->formaPagoES,
      'FechaCreacion' => $this->fechaCreacion,
      'ReqFactura' => $this->reqFactura,
      'CompraFacturada' => $this->compraFacturada,
      'idVisitante' => $this->idVisitante,
      'Nombre' => $this->nombre,
      'Email' => $this->email
    ];
  }
}
