import { Purchase } from "../types/purchase"
import PurchaseItem from "./PurchaseItem"

interface PurchasesTableProps {
  purchases: Purchase[]
}

export default function PurchasesTable({ purchases }: PurchasesTableProps) {

  return (<>
    <table className="table table-dark">
      <thead>
        <tr>
          <th scope="col">
            Id Compra
          </th>
          <th scope="col">
            Edición
          </th>
          <th>
            Estatus
          </th>
        </tr>
      </thead>
      <tbody>
        {
          purchases.map((purchase) => (
            <PurchaseItem key={purchase.id} purchase={purchase} />
          ))
        }
      </tbody>
    </table>
  </>)
}