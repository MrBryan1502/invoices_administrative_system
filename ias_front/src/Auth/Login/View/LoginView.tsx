import LoginForm from "../Components/LoginForm";
import { LoginProvider } from "../Context/LoginContext";
import '../Style/LoginStyle.css'

export default function LoginView(): React.JSX.Element {
  return (<>
    <LoginProvider>
      <div className="position-absolute top-50 start-50 translate-middle">
        <LoginForm />
      </div>
    </LoginProvider>
  </>)
}