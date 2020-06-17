{
    "openapi": "3.0.0",
    "info": {
        "title": "My API",
        "version": "0.1"
    },
    "paths": {
        "/api/admin/index": {
            "post": {
                "tags": [
                    "Admin controller"
                ],
                "summary": "show all buildings that added in the  storage.",
                "operationId": "show buildings",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/admin/approve/{id}": {
            "post": {
                "tags": [
                    "Admin controller"
                ],
                "summary": "approve building.",
                "operationId": "approve building",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "id",
                        "name": "id",
                        "in": "query",
                        "description": "building id",
                        "schema": {
                            "type": "integer"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/admin/un_approve/{id}": {
            "post": {
                "tags": [
                    "Admin controller"
                ],
                "summary": "un approve building.",
                "operationId": "un approve building",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "id",
                        "name": "id",
                        "in": "query",
                        "description": "building id",
                        "schema": {
                            "type": "integer"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/admin/makeOwner/{id}": {
            "post": {
                "tags": [
                    "Admin controller"
                ],
                "summary": "Make a customer as Owner.",
                "operationId": "make owner",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "id",
                        "name": "id",
                        "in": "query",
                        "description": "user id",
                        "schema": {
                            "type": "integer"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/admin/unMakeOwner/{id}": {
            "post": {
                "tags": [
                    "Admin controller"
                ],
                "summary": "remove privellage from Owner.",
                "operationId": "un make owner",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "id",
                        "name": "id",
                        "in": "query",
                        "description": "user id",
                        "schema": {
                            "type": "integer"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/auth/login": {
            "post": {
                "tags": [
                    "Auth"
                ],
                "summary": "JWT login",
                "description": "Login a user and generate JWT token",
                "operationId": "jwtLogin",
                "requestBody": {
                    "required": true,
                    "content": {
                        "application/json": {
                            "schema": {
                                "properties": {
                                    "email": {
                                        "description": "User email",
                                        "type": "string",
                                        "example": "ihamzehald@gmail.com"
                                    },
                                    "password": {
                                        "description": "User password",
                                        "type": "string",
                                        "example": "larapoints123"
                                    }
                                },
                                "type": "object"
                            }
                        }
                    }
                },
                "responses": {
                    "200": {
                        "description": "ok",
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "access_token": {
                                            "description": "JWT access token",
                                            "type": "string"
                                        },
                                        "token_type": {
                                            "description": "Token type",
                                            "type": "string"
                                        },
                                        "expires_in": {
                                            "description": "Token expiration in miliseconds",
                                            "type": "integer",
                                            "items": {}
                                        }
                                    },
                                    "type": "object",
                                    "example": {
                                        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
                                        "token_type": "bearer",
                                        "expires_in": 3600
                                    }
                                }
                            }
                        }
                    },
                    "401": {
                        "description": "Unauthorized"
                    }
                }
            }
        },
        "/api/auth/register": {
            "post": {
                "tags": [
                    "Auth"
                ],
                "summary": "JWT Register",
                "description": "register a user and generate JWT token",
                "operationId": "jwtLogin",
                "requestBody": {
                    "required": true,
                    "content": {
                        "application/json": {
                            "schema": {
                                "properties": {
                                    "name": {
                                        "description": "User name",
                                        "type": "string",
                                        "example": "username"
                                    },
                                    "email": {
                                        "description": "User email",
                                        "type": "string",
                                        "example": "ihamzehald@gmail.com"
                                    },
                                    "password": {
                                        "description": "User password",
                                        "type": "string",
                                        "example": "larapoints123"
                                    }
                                },
                                "type": "object"
                            }
                        }
                    }
                },
                "responses": {
                    "200": {
                        "description": "ok",
                        "content": {
                            "application/json": {
                                "schema": {
                                    "properties": {
                                        "access_token": {
                                            "description": "JWT access token",
                                            "type": "string"
                                        },
                                        "token_type": {
                                            "description": "Token type",
                                            "type": "string"
                                        },
                                        "expires_in": {
                                            "description": "Token expiration in miliseconds",
                                            "type": "integer",
                                            "items": {}
                                        }
                                    },
                                    "type": "object",
                                    "example": {
                                        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
                                        "token_type": "bearer",
                                        "expires_in": 3600
                                    }
                                }
                            }
                        }
                    },
                    "401": {
                        "description": "Unauthorized"
                    }
                }
            }
        },
        "/api/auth/me": {
            "post": {
                "tags": [
                    "Auth"
                ],
                "summary": " Get the authenticated User",
                "operationId": "Get the authenticated User",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/auth/logout": {
            "post": {
                "tags": [
                    "Auth"
                ],
                "summary": " Logout the authenticated User",
                "operationId": "Logout the authenticated User",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/owner/buildings/index": {
            "post": {
                "tags": [
                    "Owner buildings controller"
                ],
                "summary": "display a listing of the buildings that belong to the owner.",
                "operationId": "getBuildings",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/owner/buildings/store": {
            "post": {
                "tags": [
                    "Owner buildings controller"
                ],
                "summary": "Store a newly created builging in storage",
                "operationId": "SearchBuildings",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "city",
                        "name": "city",
                        "in": "query",
                        "description": "The city name",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "town",
                        "name": "town",
                        "in": "query",
                        "description": "The town name",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "type",
                        "name": "type",
                        "in": "query",
                        "description": "The type",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "price",
                        "name": "price",
                        "in": "query",
                        "description": "price",
                        "schema": {
                            "type": "double"
                        }
                    },
                    {
                        "parameter": "description",
                        "name": "description",
                        "in": "query",
                        "description": "description",
                        "schema": {
                            "type": "string"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/owner/buildings/show/{id}": {
            "post": {
                "tags": [
                    "Owner buildings controller"
                ],
                "summary": "Display the specified building.",
                "operationId": "show buildings",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "id",
                        "name": "id",
                        "in": "query",
                        "description": "building id",
                        "schema": {
                            "type": "integer"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/owner/buildings/update/{id}": {
            "post": {
                "tags": [
                    "Owner buildings controller"
                ],
                "summary": "Update the specified building in storage",
                "operationId": "update buildinsg",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "id",
                        "name": "id",
                        "in": "query",
                        "description": "building id",
                        "schema": {
                            "type": "integer"
                        }
                    },
                    {
                        "parameter": "city",
                        "name": "city",
                        "in": "query",
                        "description": "The city name",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "town",
                        "name": "town",
                        "in": "query",
                        "description": "The town name",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "type",
                        "name": "type",
                        "in": "query",
                        "description": "The type",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "price",
                        "name": "price",
                        "in": "query",
                        "description": "price",
                        "schema": {
                            "type": "double"
                        }
                    },
                    {
                        "parameter": "description",
                        "name": "description",
                        "in": "query",
                        "description": "description",
                        "schema": {
                            "type": "string"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/owner/buildings/destroy/{id}": {
            "post": {
                "tags": [
                    "Owner buildings controller"
                ],
                "summary": "Remove the specified building.",
                "operationId": "remove building",
                "parameters": [
                    {
                        "parameter": "token",
                        "name": "token",
                        "in": "query",
                        "description": "user token",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "id",
                        "name": "id",
                        "in": "query",
                        "description": "building id",
                        "schema": {
                            "type": "integer"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/index": {
            "get": {
                "tags": [
                    "Home"
                ],
                "summary": "Get last 6 buildings from storage.",
                "operationId": "getBuildings",
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        },
        "/api/search": {
            "post": {
                "tags": [
                    "Home"
                ],
                "summary": "Search buildings",
                "operationId": "SearchBuildings",
                "parameters": [
                    {
                        "parameter": "city",
                        "name": "city",
                        "in": "query",
                        "description": "The city name",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "town",
                        "name": "town",
                        "in": "query",
                        "description": "The town name",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "type",
                        "name": "type",
                        "in": "query",
                        "description": "The type",
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "parameter": "max_price",
                        "name": "max_price",
                        "in": "query",
                        "description": "max price",
                        "schema": {
                            "type": "double"
                        }
                    },
                    {
                        "parameter": "min_price",
                        "name": "min_price",
                        "in": "query",
                        "description": "min price",
                        "schema": {
                            "type": "double"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "successful operation"
                    },
                    "406": {
                        "description": "not acceptable"
                    },
                    "500": {
                        "description": "internal server error"
                    }
                }
            }
        }
    }
}