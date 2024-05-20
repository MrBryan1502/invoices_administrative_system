import { Route } from "react-router-dom";
import DashboardView from "../Dashboard/View/DashboardView";

export default function PrivateRoutes(): React.JSX.Element {

  return (<>
    <Route path="/dashboard" element={<DashboardView />} />
  </>)
}