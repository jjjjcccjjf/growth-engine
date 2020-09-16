# API Growth Engine
URL : https://growthengine2.myoptimind.com/api/

Growth Engine API
1. **User Login**
	+ [Login](#login)


2. **Invoice**
    + [Uncollected Invoice](#uncollected-invoice)
    + [Collected Invoice](#collected-invoice)
    + [Get Specific Invoice](#get-specific-invoice)
    + [Tag as Collected](#tag-as-collected)
    + [Tag as Deliver](#tag-as-deliver)

## Users Login

### Login
POST `api/users/login`

|      Name      | Required |   Type    |    Description        |    Sample Data 
|----------------|----------|-----------|-----------------------|-----------------------
| email        |  yes     |  varchar      |        -              |  qcjauili+collection@myoptimind.com
| password       |  yes     |  varchar |      |  supersecret!

<strong>Response</strong>
```javascript
200 OK
{
    "data": {
        "id": "15",
        "email": "cjauili+collection@myoptimind.com",
        "name": "Cath (Collection)",
        "role_title": "collection",
        "profile_pic_filename": null,
        "contact_num": "0",
        "last_checked_notif_at": null,
        "created_at": "2020-08-03 11:31:45",
        "updated_at": null
    },
    "meta": {
        "message": "User logged-in successfully",
        "code": "OK",
        "status": "200"
    }
}
```
## INVOICE

### Uncollected Invoice
GET `api/invoices/uncollected_invoice/`

NOTE: This displayed all uncollected invoice where the <strong>due_date</strong> field (invoice table) is equal to the current month and <strong>collected_date</strong> is NULL or 0000-00-00.

<strong>Response</strong>
```javascript
200  OK
{
    "data": [
        {
            "id": "100",
            "invoice_name": "THE ECONOMIST",
            "sale_id": "145",
            "collected_amount": "2500.00",
            "collected_date": null,
            "sent_date": null,
            "received_by": null,
            "due_date": "2020-09-10",
            "quickbooks_id": "2810",
            "created_at": "2020-09-09",
            "updated_at": "2020-09-14 09:59:17",
            "project_name": "Additional Feature on Custom Site - GA"
        },
        {
            "id": "105",
            "invoice_name": "The Economist",
            "sale_id": "154",
            "collected_amount": "5500.00",
            "collected_date": null,
            "sent_date": null,
            "received_by": null,
            "due_date": "2020-09-17",
            "quickbooks_id": "2825",
            "created_at": "2020-09-09",
            "updated_at": null,
            "project_name": "Additional Fixes on Custom WP Site"
        }
    ],
    "meta": {
        "message": "Successfuly load uncollected invoice !",
        "code": "OK",
        "status": "200"
    }
}
```

### Collected Invoice
GET `api/invoices/collected_invoice/`

<strong>Response</strong>
```javascript
200  OK
{
    "data": [
        {
            "id": "19",
            "invoice_name": "Animal Kingdom",
            "sale_id": "69",
            "collected_amount": "33600.00",
            "collected_date": "2020-06-29",
            "sent_date": null,
            "received_by": null,
            "due_date": "2020-08-18",
            "quickbooks_id": "2789",
            "created_at": "2020-08-24",
            "updated_at": "2020-08-25 15:29:16",
            "project_name": "Basic SMM"
        }
    ],
    "meta": {
        "message": "Successfuly load collected invoice !",
        "code": "OK",
        "status": "200"
    }
}
```
### Get Specific Invoice
GET `api/invoices/view_invoice/invoice_id`

Sample: localhost/growth-engine-master/api/invoices/view_invoice/100

<strong>Response</strong>
```javascript
200  OK
{
    "data": {
        "id": "100",
        "invoice_name": "THE ECONOMIST",
        "sale_id": "145",
        "collected_amount": "2500.00",
        "collected_date": null,
        "sent_date": null,
        "received_by": null,
        "due_date": "2020-09-10",
        "quickbooks_id": "2810",
        "created_at": "2020-09-09",
        "updated_at": "2020-09-14 09:59:17",
        "attachments": [
            {
                "id": "400",
                "meta_id": "100",
                "type": "invoice",
                "attachment_name": "1599642559_2810-The_Economist.pdf",
                "created_at": "2020-09-09 17:09:19",
                "updated_at": null,
                "attachment_path": "http://localhost/growth-engine-master/uploads/attachments/1599642559_2810-The_Economist.pdf"
            },
            {
                "id": "413",
                "meta_id": "100",
                "type": "invoice",
                "attachment_name": "1599877244_thankyou_1.pdf",
                "created_at": "2020-09-12 10:20:44",
                "updated_at": null,
                "attachment_path": "http://localhost/growth-engine-master/uploads/attachments/1599877244_thankyou_1.pdf"
            }
        ],
        "attachment_count": 2,
        "project_name": "Additional Feature on Custom Site - GA"
    },
    "meta": {
        "message": "Successfuly view invoice !",
        "code": "OK",
        "status": "200"
    }
}
```
### Tag as Collected
POST `/api/invoices/collect/`

|      Name      | Required |   Type    |    Description        |    Sample Data 
|----------------|----------|-----------|-----------------------|-----------------------
| id        |  yes     |  int      | invoice id             |  100
| collected_date       |  yes     |  date |      |  2020-01-12
| attachment_name[]        |  yes     |  file      |      |  sample.pdf

<strong>Response</strong>
```javascript
200  OK
{
    "data": true,
    "meta": {
        "message": "Invoice tagged as collected successfully.",
        "code": "OK",
        "status": "200"
    }
}
```

### Tag as Deliver
POST `/api/invoices/deliver/`

|      Name      | Required |   Type    |    Description        |    Sample Data 
|----------------|----------|-----------|-----------------------|-----------------------
| id        |  yes     |  int      | invoice id             |  100
| sent_date       |  yes     |  date |      |  2020-11-10
| received_by       |  yes     |  text |      |  Karen Joy Morales
| attachment_name[]        |  yes     |  file      |      |  sample.pdf

<strong>Response</strong>
```javascript
200  OK
{
    "data": true,
    "meta": {
        "message": "Invoice tagged as delivered successfully.",
        "code": "OK",
        "status": "200"
    }
}
```


