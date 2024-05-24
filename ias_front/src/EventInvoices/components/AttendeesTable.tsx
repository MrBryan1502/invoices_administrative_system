import { useEffect, useState } from "react"
import { Attendee } from "../types/attendee"
import AttendeeItem from "./AttendeeItem"

interface AttendeesTableProps {
  attendees: Attendee[]
}

export default function AttendeesTable({ attendees: initialAttendees }: AttendeesTableProps) {

  const [attendees, setAttendees] = useState(initialAttendees)

  useEffect(() => {

    setAttendees(initialAttendees)
  }, [initialAttendees]);

  const handleClick = (type: string) => {

    if (type === 'ID') {
      const orderedById = [...attendees]
      orderedById.sort((a, b) => a.id - b.id)
      setAttendees(orderedById)
      return
    }

    if (type === 'NOMBRE') {
      const orderedByNombre = [...attendees]
      orderedByNombre.sort((a, b) => a.nombre.localeCompare(b.nombre))
      setAttendees(orderedByNombre)
    }
  }

  return (<>
    <table className="table">
      <thead>
        <tr>
          <th role="button" scope="col" onClick={() => handleClick('ID')}>
            Id Visitante
          </th>
          <th role="button" scope="col" onClick={() => handleClick('NOMBRE')}>
            Nombre Visitante
          </th>
        </tr>
      </thead>
      <tbody>
        {
          attendees.map((attendee, index) => (
            <AttendeeItem key={index} attendee={attendee} index={index} onClick={() => { console.log(attendee) }} />
          ))
        }
      </tbody>
    </table>
  </>)
}