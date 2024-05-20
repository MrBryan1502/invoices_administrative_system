import { Route, Routes } from 'react-router-dom'
import LoginView from './Auth/Login/View/LoginView';
import { useContext } from 'react';
import { AuthContext } from './Shared/Context/AuthContext';

export default function App() {

  const {
    loggedIn
  } = useContext(AuthContext)

  return (
    <>
      <Routes>
        <Route
          path="/"
          element={
            loggedIn ?
              <h1>Logueado</h1> :
              <LoginView />
          }
        />
      </Routes>
    </>
  )
}
