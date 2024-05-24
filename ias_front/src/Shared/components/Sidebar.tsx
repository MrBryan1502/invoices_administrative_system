import { useState } from "react";
import { NavLink, To } from "react-router-dom";

export default function Sidebar() {

  const [expanded, setExpanded] = useState(false)

  const handleClick = () => {
    setExpanded(!expanded)
  }

  const isExpanded = expanded ? 'show' : ''

  return (<>
    <nav className="navbar navbar-expand-lg bg-dark mb-5" data-bs-theme="dark">
      <div className="container-fluid">
        <NavLink className="navbar-brand" to="/events">Invoices Administrative System</NavLink>
        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onClick={handleClick}>
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className={`collapse navbar-collapse ${isExpanded}`} id="navbarSupportedContent">
          <ul className="navbar-nav me-auto mb-2 mb-lg-0">
            <NavItem to="/events">
              Home
            </NavItem>
            <NavItem to="/signup">
              Signup
            </NavItem>
          </ul>
          <div className="d-flex">
            <NavLink className="btn btn-secondary bg-gradient" to="/login">Logout</NavLink>
          </div>
        </div>

      </div>
    </nav>
  </>)
}

interface NavItemProps {
  children: React.ReactNode
  to: To
}

function NavItem({ children, to }: NavItemProps) {

  return (<>
    <li className="nav-item">
      <NavLink aria-current="page" className="nav-link" to={to}>
        {children}
      </NavLink>
    </li>
  </>)
}