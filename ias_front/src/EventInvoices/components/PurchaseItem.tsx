import { NavLink } from "react-router-dom"
import { PURCHASE_STATUS } from "../constants/purchase"
import { Purchase, PurchaseStatus } from "../types/purchase"

interface PurchaseItemProps {
  purchase: Purchase
}

export default function PurchaseItem({ purchase }: PurchaseItemProps) {

  const {
    id,
    edicion,
    status
  } = purchase

  const statusColor = (status: PurchaseStatus) => {
    switch (status) {
      case PURCHASE_STATUS.COMPLETADA:
        return 'table-success'

      case PURCHASE_STATUS.CANCELADA:
        return 'table-danger'

      case PURCHASE_STATUS.PENDIENTE:
        return 'table-warning'

      case PURCHASE_STATUS.CORTESIA:
        return 'table-light'

      case PURCHASE_STATUS.NA:
        return 'table-info'


      default:
        break;
    }
  }

  return (<>
    {status === PURCHASE_STATUS.NA
      ?
      <tr className={`${statusColor(status)}`}>
        <th>
          {id}
        </th>
        <td>
          {edicion}
        </td>
        <td>
          <NavLink to="#">
            {'Sin facturar (click para facturar)'}
          </NavLink>
        </td>
      </tr>
      :
      <tr className={`${statusColor(status)}`}>
        <th>
          {id}
        </th>
        <td>
          {edicion}
        </td>
        <td>
          {status}
        </td>
      </tr>
    }
  </>)
}