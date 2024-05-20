import { useContext } from "react"
import { AuthContext } from "../Context/AuthContext"
import { useNavigate } from "react-router-dom"

export default function LogoutButton(): React.JSX.Element {

  const navigate = useNavigate()
  const { setAuth } = useContext(AuthContext)

  const onLogout = () => {

    localStorage.setItem('token', '')
    setAuth(false)
    navigate('/')
  }

  return (<>
    <button
      className="btn btn-primary"
      onClick={onLogout}
    >
      Logout
    </button>
  </>)
}