import LogoutButton from "./LogoutButton"

interface SidebarProps {
  SBOpen: boolean,
  setSBOpen: React.Dispatch<React.SetStateAction<boolean>>
}

export function Sidebar({
  SBOpen,
  setSBOpen
}: SidebarProps): React.JSX.Element {

  const closeSidebar = () => {
    console.log(close)
    setSBOpen(false)
  }

  return (<>
    <div className={`offcanvas offcanvas-start${SBOpen ? ' show' : ''}`} tabIndex={-1} id="sidebar" aria-labelledby="sidebarLabel">
      <div className="offcanvas-header">
        <h5 className="offcanvas-title" id="sidebarLabel">Invoices Administrative System</h5>
        <button
          type="button"
          className="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
          onClick={closeSidebar}
        ></button>
      </div>
      <div className="offcanvas-body">
        <LogoutButton />
        {/* <div className="dropdown mt-3">
          <button className="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            Dropdown button
          </button>
          <ul className="dropdown-menu">
            <li><a className="dropdown-item" href="#">Action</a></li>
            <li><a className="dropdown-item" href="#">Another action</a></li>
            <li><a className="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div> */}
      </div>
    </div>
  </>)
}

interface SidebarButtonProps {
  setSBOpen: React.Dispatch<React.SetStateAction<boolean>>
}

export function SidebarButton({
  setSBOpen
}: SidebarButtonProps) {

  const openSidebar = () => {
    console.log('open')
    setSBOpen(true)
  }

  return (<>
    <button
      className="btn btn-primary border bg-transparent text-black"
      type="button"
      data-bs-toggle="sidebar"
      data-bs-target="#sidebar"
      aria-controls="sidebar"
      onClick={openSidebar}
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-list" viewBox="0 0 16 16">
        <path fillRule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
      </svg>
    </button>
  </>)
}