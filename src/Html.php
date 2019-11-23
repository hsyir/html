<?php

namespace Hsy\Html;

use Mockery\Exception;

class Html
{

    private $htmlEntities = [];

    private $arguments = [];
    private $parameters = [];

    private $renderable = true;

    private $htmlEntity = "text";

    public function __construct()
    {
        $this->arguments = config('html.arguments');
        $this->argumentsAsArray = config('html.argumentsAsArray');
        $this->htmlEntities = config('html.htmlEntities');
    }

    public function when($renderable)
    {
        $this->renderable = $renderable ? true : false;
        return $this;
    }

    private function getViewFileName()
    {
        $path = 'html::';
        $viewFileName = $path . "_" . $this->htmlEntity;
        if (view()->exists($viewFileName))
            return $viewFileName;

        throw new \Exception('View File Not Found: ' . "$viewFileName");
    }

    private function resetParameters()
    {
        $this->renderable = true;
        $this->parameters = [];
    }


    public function __toString()
    {
        if (!$this->renderable) {
            $this->resetParameters();
            return "";
        }
        $html = "";

        try {
            $view = $this->getViewFileName();
            $html = view($view, $this->parameters)->render();
        } catch (\Exception $exception) {
            dump($this->parameters, $view);
            dd($exception->getMessage());
        }

        $this->resetParameters();

        echo $html;
        return "";
    }


    public function __call($methodName, $args)
    {
        $firstArg = isset($args[0]) ? $args[0] : null;

        try {
            if ($this->trySetEntityType($methodName, $firstArg))
                return $this;
            if ($this->trySetParameter($methodName, $firstArg))
                return $this;

            $this->tryAddAsAttribute($methodName, $firstArg);


        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $this;
    }

    private function trySetEntityType($htmlEntity, $nameAttribute = null)
    {
        //try to set field type
        if (in_array($htmlEntity, $this->htmlEntities)) {
            $this->htmlEntity = $htmlEntity;
            if ($nameAttribute)
                $this->parameters['name'] = $nameAttribute;
            return true;
        }
        return false;
    }

    private function trySetParameter($parameter, $value)
    {
        if (in_array($parameter, $this->arguments)) {
            $this->parameters[$parameter] = $value;
            return true;
        }
        return false;
    }

    private function tryAddAsAttribute($attribute, $value)
    {

        $this->parameters['attributes'][$attribute] = $value;
    }

}