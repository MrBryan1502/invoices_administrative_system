import { BrowserRouter, Navigate, Route, Routes } from "react-router-dom";
import Login from "./pages/Login";
import EventsDashboard from "./pages/EventsDashboard";
import EventInvoices from "./pages/EventInvoices";
import Signup from "./pages/Signup";

export default function Router() {

  const isAuth = true

  return (<>
    <BrowserRouter>
      <Routes>
        {/* PUBLIC ROUTES */}
        <Route
          path="/login"
          element={
            isAuth
              ?
              <Navigate to="/" />
              :
              <Login />}
        />
        {/* PRIVATE ROUTES */}
        <Route
          path="/"
          element={
            isAuth
              ?
              <Navigate to="/events" />
              :
              <Navigate to="/login" />
          }
        />
        <Route
          path="/signup"
          element={
            isAuth
              ?
              <Signup />
              :
              <Navigate to="/login" />
          }
        />
        <Route path="/events">
          <Route
            path=":idConexion"
            element={
              isAuth
                ?
                <EventInvoices />
                :
                <Navigate to="/" />
            }
          />
          <Route
            index
            element={
              isAuth
                ?
                <EventsDashboard />
                :
                <Navigate to="/" />
            }
          />
        </Route>
      </Routes>
    </BrowserRouter>
  </>)
}