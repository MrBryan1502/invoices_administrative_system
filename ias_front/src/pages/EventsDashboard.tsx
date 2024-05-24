import Sidebar from "../Shared/components/Sidebar";
import EventItem from "../EventDashboard/components/EventItem";
import InputSearch from "../Shared/components/InputSearch";
import { useState } from "react";

interface Event {
  id: number
  nombre: string
}

export default function EventsDashboard() {

  const initialEvents = [
    {
      id: 1,
      nombre: 'Amic Dental',
    },
    {
      id: 2,
      nombre: 'Expo Med',
    },
    {
      id: 3,
      nombre: 'Abastur',
    },
  ]

  /* const renderLoaders = () => {

    const loadersToRender = 3
    const loaders: React.ReactNode[] = []

    for (let i = 0; i < loadersToRender; i++) {

      loaders.push(<li className="col mb-5">
        <NavLink className="p-5 rounded btn btn-danger bg-gradient disabled" to="/events/135">
          <span className="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
          Cargando...
        </NavLink>
      </li>)
    }

    return loaders
  } */

  const [events, setEvents] = useState<Event[]>(initialEvents);

  const handleChange = ({ target }: React.ChangeEvent<HTMLInputElement>) => {
    const value = target.value;
    const filteredEvents = initialEvents.filter(event =>
      event.nombre.toLowerCase().includes(value.toLowerCase()) ||
      event.id.toString().includes(value)
    );
    setEvents(filteredEvents);
  };

  return (<>
    <Sidebar />
    <article className="container text-center">
      <section className="card py-5" style={{ minHeight: "400px" }}>
        <InputSearch onChange={handleChange} />
        <ul className="row row-cols-3 g-2">
          {
            events.map(({ id, nombre }) => (
              <EventItem key={id} to={`/events/${id}`}>
                {nombre}
              </EventItem>
            ))
          }
          {/* renderLoaders().map((loader) => loader) */}
        </ul>
      </section>
    </article>
  </>)
}