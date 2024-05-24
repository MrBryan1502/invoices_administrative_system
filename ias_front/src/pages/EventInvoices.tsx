import { useState } from "react";
import Sidebar from "../Shared/components/Sidebar";
import AttendeesTable from "../EventInvoices/components/AttendeesTable";
import { Attendee } from "../EventInvoices/types/attendee";
import InputSearch from "../Shared/components/InputSearch";

export default function EventInvoices() {
  const initialAttendees: Attendee[] = [
    {
      id: 1,
      nombre: 'Bryan',
      purchases: [
        {
          id: 1,
          edicion: 3,
          status: 'PENDIENTE'
        },
        {
          id: 2,
          edicion: 3,
          status: 'COMPLETADA'
        },
        {
          id: 3,
          edicion: 4,
          status: 'CANCELADA'
        }
      ]
    },
    {
      id: 2,
      nombre: 'Juanito',
      purchases: [
        {
          id: 4,
          edicion: 3,
          status: 'NA'
        },
        {
          id: 5,
          edicion: 3,
          status: 'COMPLETADA'
        },
        {
          id: 6,
          edicion: 4,
          status: 'CANCELADA'
        },
      ]
    },
    {
      id: 3,
      nombre: 'Johny',
      purchases: [
        {
          id: 7,
          edicion: 2,
          status: 'COMPLETADA'
        },
        {
          id: 8,
          edicion: 3,
          status: 'COMPLETADA'
        },
        {
          id: 9,
          edicion: 2,
          status: 'PENDIENTE'
        },
      ]
    }
  ];

  const [attendees, setAttendees] = useState<Attendee[]>(initialAttendees);

  const handleChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const value = event.target.value;
    const filteredAttendees = initialAttendees.filter(attendee =>
      attendee.nombre.toLowerCase().includes(value.toLowerCase()) ||
      attendee.id.toString().includes(value)
    );
    setAttendees(filteredAttendees);
  };

  return (
    <>
      <Sidebar />
      <section className="container">
        <article className="card p-3">
          <InputSearch onChange={handleChange} />
          <AttendeesTable attendees={attendees} />
        </article>
      </section>
    </>
  );
}
