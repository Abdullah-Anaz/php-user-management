import "./App.css";
import "bootstrap/dist/css/bootstrap.min.css";
import Home from "./pages/home";
import { Route, Routes } from "react-router-dom";
import AddUserForm from "./pages/add";
import EditUserForm from "./pages/edit";

function App() {
  return (
    <div className="App">
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/insert" element={<AddUserForm />} />
        <Route path="/edit/:id" element={<EditUserForm />} />
      </Routes>
    </div>
  );
}

export default App;
