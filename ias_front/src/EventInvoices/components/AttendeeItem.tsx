import { useEffect, useState } from "react"
import { Attendee } from "../types/attendee"
import PurchasesTable from "./PurchasesTable"
import { Purchase } from "../types/purchase"
import InputSearch from "../../Shared/components/InputSearch"

interface AttendeeItemProps {
  attendee: Attendee
  index: number
  onClick: () => void
}

export default function AttendeeItem({ attendee, onClick, index }: AttendeeItemProps) {

  const [expanded, setExpanded] = useState(false)

  const {
    id,
    nombre,
    purchases: initialPurchases
  } = attendee

  const rowColor = (index: number) => {
    if (index % 2 === 0) {
      return 'table-secondary'
    }
    return 'table-light'
  }

  const handleClick = () => {
    setExpanded(!expanded)
    onClick()
  }

  const isExpanded = expanded ? 'show' : ''

  const [purchases, setPurchases] = useState<Purchase[]>(initialPurchases);

  useEffect(() => {
    setPurchases(initialPurchases)
  }, [initialPurchases])



  const handleChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const value = event.target.value;
    const filteredPurchases = initialPurchases.filter(purchase =>
      purchase.status.toLowerCase().includes(value.toLowerCase()) ||
      purchase.id.toString().includes(value) ||
      purchase.edicion.toString().includes(value)
    );
    setPurchases(filteredPurchases);
  };

  return (<>
    <tr className={`${rowColor(index)}`} data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="info" onClick={handleClick}>
      <th>
        {id}
      </th>
      <td>
        {nombre}
      </td>
    </tr>
    <tr className={`${rowColor(index)} collapse ${isExpanded}`}>
      <td colSpan={2}>
        <InputSearch onChange={handleChange} />
        <PurchasesTable purchases={purchases} />
      </td>
    </tr>
  </>)
}