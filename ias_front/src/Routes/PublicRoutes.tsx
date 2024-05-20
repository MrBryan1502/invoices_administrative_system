import { Route } from "react-router-dom";
import LoginView from "../Auth/Login/View/LoginView";

export default function PublicRoutes(): React.JSX.Element {

  return (<>
    <Route path="/" element={<LoginView></LoginView>} />
  </>)
}