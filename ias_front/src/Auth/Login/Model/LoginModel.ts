import { API_LOGIN } from "../../../env";
import { type LoginFetchSuccess, type LoginFetchError } from "../Types/types";

export default async function fetchLogin(email: string, password: string): Promise<LoginFetchSuccess> {

  const BODY = {
    Email: email,
    Password: password
  }

  const REQUEST_CONFIG: RequestInit = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(BODY)
  }

  const response = await fetch(API_LOGIN, REQUEST_CONFIG)

  if (!response.ok && response.status !== 200) {
    const data: LoginFetchError = await response.json()
    throw new Error(data.error);
  }

  const data: LoginFetchSuccess = await response.json()

  return data
}