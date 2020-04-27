const sql = require("../config/db");

// constructor
const Contact = function(contact) {
  this.name       = contact.name;
  this.number     = contact.number;
  this.address    = contact.address;
  this.birthplace = contact.birthplace;
  this.birthday   = contact.birthday;
  this.info       = contact.info;
};

// Create
Contact.create = (newContact, result) => {
  sql.query("INSERT INTO contact SET ?", newContact, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }

    console.log("created contact: ", { id: res.insertId, ...newContact });
    result(null, { id: res.insertId, ...newContact });
  });
};

// Get All
Contact.getAll = result => {
  sql.query("SELECT * FROM contact ORDER BY id DESC", (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(null, err);
      return;
    }

    console.log("contact: ", res);
    result(null, res);
  });
};

// Detail (Get by Id)
Contact.findById = (contactId, result) => {
  sql.query(`SELECT * FROM contact WHERE id = ${contactId}`, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }

    if (res.length) {
      console.log("found contact: ", res[0]);
      result(null, res[0]);
      return;
    }

    // not found Contact with the id
    result({ kind: "not_found" }, null);
  });
};

// update by Id
Contact.updateById = (id, contact, result) => {
  sql.query(
    "UPDATE contact SET name = ?, number = ?, address = ?, birthplace = ?, birthday = ?, info = ? WHERE id = ?",
    [contact.name, contact.number, contact.address, contact.birthplace, contact.birthday, contact.info, id],
    (err, res) => {
      if (err) {
        console.log("error: ", err);
        result(null, err);
        return;
      }

      if (res.affectedRows == 0) {
        // not found Contact with the id
        result({ kind: "not_found" }, null);
        return;
      }

      console.log("updated contact: ", { id: id, ...contact });
      result(null, { id: id, ...contact });
    }
  );
};

// Delete by Id
Contact.remove = (id, result) => {
  sql.query("DELETE FROM contact WHERE id = ?", id, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(null, err);
      return;
    }

    if (res.affectedRows == 0) {
      // not found Contact with the id
      result({ kind: "not_found" }, null);
      return;
    }

    console.log("deleted contact with id: ", id);
    result(null, res);
  });
};

// Delete All
Contact.removeAll = (idArray, result) => {
  sql.query("DELETE FROM contact WHERE id IN (?)", [idArray], (err, res) => {
      if (err) {
        console.log("error: ", err);
        result(null, err);
        return;
      }
  
      if (res.affectedRows == 0) {
        // not found Contact with the id
        result({ kind: "not_found" }, null);
        return;
      }
  
      console.log("deleted contact with id: ",err, res, idArray);
      result(null, res);
    })
};

// Check Contact Exists
Contact.findByNumber = (contactNumber, id, callback) => {
  if (id != null) {
    sql.query(`SELECT * FROM contact WHERE id != ${id} AND number = ${contactNumber}`, (err, result) => {
      console.log("res1: ", result);
      callback(err, result);
    });
  }else{
    sql.query(`SELECT * FROM contact WHERE number = ${contactNumber}`, (err, result) => {
      console.log("res1: ", result);
      callback(err, result);
    });
  }
};

module.exports = Contact;