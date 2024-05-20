import { createContext, useMemo, useReducer, useEffect } from "react";
import { toast } from "sonner";
import { AuthActionType, JWT, ReducerParamsType } from "../Types/types";
import { AUTH_ACTION_TYPE } from "../Constants/constants";
import { API_LOGIN } from "../../env";
import { AuthState, FetchLoginError, FetchLoginResponse, UserLogin } from "../../Auth/Shared/types";
import { jwtDecode } from "jwt-decode";

interface AuthProviderProps {
  children: React.ReactNode;
}

const authReducer = (state: AuthState, { type, payload }: ReducerParamsType<AuthActionType, boolean>): AuthState => {
  switch (type) {
    case AUTH_ACTION_TYPE.SET_LOGGEDIN_VALUE:
      return { ...state, loggedIn: payload };
    default:
      return state;
  }
};

const initialAuthState: AuthState = {
  loggedIn: false,
};

export const AuthContext = createContext<AuthState>(initialAuthState);

export function AuthProvider({ children }: AuthProviderProps) {
  const [state, dispatch] = useReducer(authReducer, initialAuthState);

  const verifySession = () => {
    const tokenString = localStorage.getItem("token");

    if (!tokenString) {
      dispatch({
        type: AUTH_ACTION_TYPE.SET_LOGGEDIN_VALUE,
        payload: false,
      });
      return;
    }

    try {
      const token: JWT = jwtDecode(tokenString);
      const dateNow = new Date();
      const tokenExp = new Date(token.exp * 1000);

      if (tokenExp <= dateNow) {
        localStorage.removeItem("token");
        dispatch({
          type: AUTH_ACTION_TYPE.SET_LOGGEDIN_VALUE,
          payload: false,
        });
        return;
      }

      dispatch({
        type: AUTH_ACTION_TYPE.SET_LOGGEDIN_VALUE,
        payload: true,
      });
    } catch (error) {
      localStorage.removeItem("token");
      dispatch({
        type: AUTH_ACTION_TYPE.SET_LOGGEDIN_VALUE,
        payload: false,
      });
    }
  };

  const login = async (user: UserLogin) => {
    const requestBody = { ...user };

    const requestConfig: RequestInit = {
      method: "POST",
      headers: {
        "Content-Type": "application/json", // Corregido 'application-json' a 'application/json'
      },
      body: JSON.stringify(requestBody),
    };

    try {
      const response = await fetch(API_LOGIN, requestConfig);

      if (!response.ok) {
        const jsonResponse: FetchLoginError = await response.json();
        toast.warning(jsonResponse.error);
        return;
      }

      const jsonResponse: FetchLoginResponse = await response.json();
      localStorage.setItem("token", jsonResponse.token);

      dispatch({
        type: AUTH_ACTION_TYPE.SET_LOGGEDIN_VALUE,
        payload: true,
      });
    } catch (error) {
      toast.error("Error de red o del servidor");
      console.error("Error during login:", error);
    }
  };

  const logout = () => {
    localStorage.removeItem("token");
    dispatch({
      type: AUTH_ACTION_TYPE.SET_LOGGEDIN_VALUE,
      payload: false,
    });
  };

  useEffect(() => {
    verifySession();
  }, []);

  const contextValue = useMemo(() => ({
    loggedIn: state.loggedIn,
    login,
    logout,
    verifySession,
  }), [state.loggedIn]);

  return (
    <AuthContext.Provider value={contextValue}>
      {children}
    </AuthContext.Provider>
  );
}
