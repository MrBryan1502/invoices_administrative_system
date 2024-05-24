import { NavLink, To } from "react-router-dom";

interface EventItemProps {
  to: To
  children: React.ReactNode
}

export default function EventItem({ children, to }: EventItemProps) {

  return (<>
    <li className="col mb-5">
      <NavLink className="p-5 rounded btn btn-danger bg-gradient" to={to}>
        {children}
      </NavLink>
    </li>
  </>)
}