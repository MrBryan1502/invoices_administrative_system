import fetchLogin from "../Model/LoginModel";
import { userEmail, userPassword } from "../Validations/UserValidations";

export async function Login(email: string, password: string) {

  userEmail(email)
  userPassword(password)
  const response = await fetchLogin(email, password)
  localStorage.setItem('token', response.token)

  return response
}