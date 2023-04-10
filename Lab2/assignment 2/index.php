<?php
session_start(); 
$fileName = "employees.xml";
$fileContent = file_get_contents($fileName);
$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
$doc->loadXML($fileContent);
$elements = $doc->getElementsByTagName("employee")->length;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] === "insert") {
        $employees = simplexml_load_file('employees.xml');
		$employee = $employees->addChild('employee');
        $employee->addChild('id', uniqid());
		$employee->addChild('name', $_POST['name']);
		$employee->addChild('email', $_POST['email']);
		$employee->addChild('phone', $_POST['phone']);
		$employee->addChild('address', $_POST['address']);
        $DOM = new DomDocument();
		$DOM->preserveWhiteSpace = false;
		$DOM->formatOutput = true;
		$DOM->loadXML($employees->asXML());
		$DOM->save('employees.xml');
		header('location: index.php');
    }
    $index = $_SESSION["index"];
    if ($_POST["action"] === "next" && $index < $elements-1) {
        $_SESSION["index"] += 1;
    }

    if ($_POST["action"] === "prev" && $index > 0) {
        $_SESSION["index"] -= 1;
    }
    if ($_POST["action"] === "update") {
        
        $xml = simplexml_load_file('employees.xml');

        $id = $_POST['id'];
        $employee = $xml->xpath("//employee[id='$id']")[0];
        $employee->name = $_POST['name'];
        $employee->phone = $_POST['phone'];
        $employee->address = $_POST['address'];
        $employee->email = $_POST['email'];

        $xml->asXML('employees.xml');

    }
    if ($_POST["action"] === "delete") {
        
        $xml = simplexml_load_file('employees.xml');

        $id = $_POST['id'];
        $employee = $xml->xpath("//employee[id='$id']")[0];
        unset($employee[0]);

        $xml->asXML('employees.xml');
    }
}



$index = $_SESSION["index"];
$employees = $doc->documentElement;
$employee = @$employees->childNodes[$index];
$id = @$employee->childNodes[0]->nodeValue;
$name = @$employee->childNodes[1]->nodeValue;
$email = @$employee->childNodes[2]->nodeValue;
$phone = @$employee->childNodes[3]->nodeValue;
$address = @$employee->childNodes[4]->nodeValue;


require_once("form.php");