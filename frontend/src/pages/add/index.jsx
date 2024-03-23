import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import "./index.css";
import Form from "common/form";

function AddUserForm() {
  const navigate = useNavigate();

  const [user, setUser] = useState({ name: "", email: "" });

  const onChangeValue = (e) => {
    setUser({ ...user, [e.target.id]: e.target.value });
  };

  const addUser = (e) => {
    e.preventDefault();
    axios
      .post(`${process.env.REACT_APP_BASE_URL}/routes.php?action=addUser`, user)
      .then((res) => {
        clearInputs();
        navigate("/");
      })
      .catch((err) => {
        console.log(err);
      });
  };

  const clearInputs = () => {
    setUser({ name: "", email: "" });
  };

  return (
    <div className="form-container insert-form">
      <h2>Add Form</h2>
      <Form
        onSubmit={addUser}
        onChangeValue={onChangeValue}
        user={user}
        btnText="Add User"
      />
    </div>
  );
}

export default AddUserForm;
